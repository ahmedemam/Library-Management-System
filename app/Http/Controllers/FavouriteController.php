<?php

namespace App\Http\Controllers;

use Session;
use App\Favourite;
use App\Book;
use Auth;

use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {

      $id=Auth::id();      
      $favourites=Favourite::where('user_id',$id)->paginate(5);
    //   $books=[];
    //   foreach ($favourites as $favourite) {
    //     $book= Book::where('id',$favourites->book_id);
    //       array_push($books,$book);
    //   }
    
     return view('favourites.index')->with('favouriteBooks',$favourites);
    }


    public function create()
    {
        return redirect()->route('favourites.index');
    }


    public function store(Request $request)
    {
       
        $favourite = new Favourite;
        $favourite->book_id = $request->book_id;
        $favourite->user_id = $request->user_id;
       

        if(Favourite::find($request->book_id)){
           
            Session::flash('sucess', ' Sorry This Book already in your Favourites .');
         return view('books.index');
        }
        else{
     
            $favourite->save();
        Session::flash('success', 'New book has been sucessfully added to your Favourites .');
         return redirect()->route('favourites.index');
        }
    }


   





    public function destroy($id)
    {
        
      Favourite::find($id)->delete();
     return redirect()->route('favourites.index');
    }


}