<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Book;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $book_id=0;


     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        
        $Uid= Auth::id();
        $comments = Comment::where('user_id',$Uid);
        $book=Book::where('id',$id);
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
        // $this->authorize('create', Comment::class);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $user = Auth::user();
        
    
        $this->validate($request, [
            'review' => 'required|min:10|max:255',
            'rate'=>'required|between:0,5'
        ]);
        
        $review = new Comment;
        $review->user_id = Auth::id();
        $review->review = $request->review;
        $review->rate = $request->rate;
        $review->book_id = $request->book_id;
        $bookId=$request->book_id;
        $this->authorize('store', $review);
        $review->save();
       $this-> avgRate($bookId);
       $comments = Comment::where('book_id',$bookId)->get();
       $book=Book::find($bookId);
    //   return view('books.book')->with(['book' => $book])->with(['storedComments'=> $comments]);
    return back()->with(['book' => $book])->with(['storedComments'=> $comments]);

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
    public function destroy($id)
    {
         $review = Comment::find($id);
         
         $book=Book::find($review->book->id);
         $this->authorize('delete', $review);
         $review ->delete();
      
      
      $comments = Comment::where('book_id',$review->book->id)->get();
      
      return back()->with(['book' => $book])->with(['storedComments'=> $comments]);
      //return view('books.book')->with(['book' => $book])->with(['storedComments'=> $comments]);
    }

  
}