<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Book;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($book_id)
    {
        
        $Uid= Auth::id();
        $comments = Comment::where('user_id',$Uid);
        $book=Book::where('id',$book_id);
        return view('books.book')->with(['book' => $book,'storedComments'=> $comments]);
    }

    public function avgRate($book_id)
    {
        $rates = Comment::where('book_id', $book_id)->get();
        
        $totalRate = 0;
        $totalUsers = count($rates);
      //  echo $totalUsers;
        if (count($rates) > 0) {
          
            foreach ($rates as $ratee) {
        //        echo $ratee->rate;
                $totalRate += $ratee->rate;
            }
        }
        $avgRate = $totalRate / $totalUsers;
        //echo $avgRate;
        Book::where('id', $book_id)->update(["rate" => $avgRate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('books.book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$book_id)
    {
        // echo "hello";
        
        $this->validate($request, [
            'review' => 'required|min:10|max:255',
        ]);
        $review = new Comment;
        //$review->user_id = Auth::user()->id();
        $review->user_id = 1;
        $review->review = $request->review;
        $review->rate = $request->rate;
        $review->book_id = $request->book_id;
        $bookId=$request->book_id;

        $review->save();
       $this-> avgRate($book_id);
       //Session::flash('success', 'New review has been succesfully added!');
       $book=Book::find($book_id);
       $comments = Comment::where('book_id',$book_id)->get();
       return view('books.book')->with(['book' => $book])->with(['storedComments'=> $comments]);
    // return redirect()->route('comments.index',$book_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$book_id)
    {

       
        echo $id;
         $review = Comment::find($id)->delete();
         $this->authorize('delete', $review);
      //  Session::flash('success', 'comment has been successfully deleted.');
      $book=Book::find($book_id);
      $comments = Comment::where('book_id',$book_id)->get();
      return view('books.book')->with(['book' => $book])->with(['storedComments'=> $comments]);
    }



  
}