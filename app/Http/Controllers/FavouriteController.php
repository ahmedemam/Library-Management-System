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
     $favourite=Favourite::where('user_id',$id);
     $favourites = $favourite->books()->get();
    // $favourite=$favourite->books();
      
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
        $favourite->save();
         return redirect()->route('favourites.index');
        
    }


   

    public function destroy($id)
    {
        
        
    $favourites=Favourite::where('book_id',$id)->delete();
    return redirect()->route('favourites.index');
    }


}