<?php

namespace App\Http\Controllers;

use Session;
use App\Favourite;
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
      return view('favourites.index')->with('favourites', $favourites);
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
        Session::flash('success', 'New book has been sucessfully added to your Favourites .');
        return redirect()->route('favourites.index');
    }


   





    public function destroy($id)
    {
        $favourite = Favourite::find($id);
        $favourite->delete();
        return redirect()->route('favourites.index');
    }


}