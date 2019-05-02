<?php

namespace App\Http\Controllers;

use App\Review;
use App\Book;
use Illuminate\Http\Request;

class ReviewBook extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
     } 
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createComment()
    {
        return view('user.createComment');
    }

    public function createRate()
    {
        return view('user.createRate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        $this->validate($request, [
            'review' => 'required|min:10|max:255',
        ]);
        $review = new Review;
        $review->user_id = 'auth'::id();
        $review->review = $request->review;
        $review->book_id=$request->book_id;
        
        
        $review->save();
        Session::flash('success', 'New comment has been succesfully added!');
     //   return redirect()->route('books.index');
    }


    public function storeRate(Request $request)
    {
        $this->validate($request, [
            'rate' => 'required|between:0,5',
           
        ]);
        $review = new Review;
        $review->user_id = 'auth'::id();
        $review->rate = $request->rate;
        $review->book_id=$request->book_id;
        
        
        $review->save();
        avgRate($request->book_id);
        Session::flash('success', 'New rate has been succesfully added!');
       // return redirect()->route('books.index');
    }

    public function avgRate($book_id){
        $rates = Review::where('book_id',$book_id);
        $users = User::all();
        $totalRate=0;
        $totalUsers=count($users);
        if(count($rates)>0){

            foreach($rates as $rate){
                $totalRate+=$rate->$rate;
            }
        }
        $avgRate=$totalRate/$totalUsers;
        Book::where('id',$book_id)->update(["rate"=>$avgRate]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        Session::flash('success', 'comment has been successfully deleted.');
       // return redirect()->route('books.index');
    }
}