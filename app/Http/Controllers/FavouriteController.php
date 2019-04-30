<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {

//        $id='auth'::id();
//        $favourites=FavouriteController::where('user_id',$id)->paginate(5);
//        return view('favourites.index')->with('favourites', $favourites);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|min:10|max:255']);
        $favourite = new FavouriteController;
        $favourite->name = $request->name;
        $favourite->book_id = $request->book_id;
        $favourite->user_id = $request->user_id;
        if (FavouriteController::find()->all() > where())
            $favourite->save();
        Session::flash('success', 'New book has been sucessfully added to your Favourites .');
        return redirect()->route('favourites.index');
    }


    public function show(FavouriteController $favourite)
    {
        //
    }


    public function edit(FavouriteController $favourite)
    {
        $this->authorize('update', $favourite);
        $favourite = FavouriteController::find($favourite->id);
        return view('favourites.update')->with('favourites', $favourite);
    }


    public function update(Request $request, FavouriteController $favourite)
    {
        $this->authorize('update', $favourite);
        $favourites = FavouriteController::all();
        $favourite = FavouriteController::find($favourite->id);
        $favourite->name = $request->name;
        $favourite->book_id = $request->book_id;
        $favourite->user_id = $request->user_id;
        $favourite->save();
        return redirect()->route('favourites.index');
    }


    public function destroy($id)
    {
        $favourite = FavouriteController::find($id);
        $favourite->delete();
        return redirect()->route('favourites.index');
    }


}
