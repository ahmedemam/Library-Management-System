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
     $favourite=Favourite::where('user_id',$id)->get();
     $favourites=[];
     foreach ($favourite as $key) {
         
        array_push($favourites,Book::find($key->book_id));
     }
    
     
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

        $book=Favourite::where('book_id',$request->book_id)->get();
       
         

        if(count($book)>0){
          return redirect()->route('favourites.index');
        }
        else{    
        $favourite->save();
         return redirect()->route('favourites.index');
        }
    }


   

    public function destroy($id)
    {
   
        
    $favourites=Favourite::where('book_id',$id);
    $favourites->delete();
      
  
   return redirect()->route('favourites.index')->with('success','category deleted succesfly');
    }


}