<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

class Favourite extends Controller
{
   
     public function __construct(){

        $this->middleware('auth');
    }

    public function index()
    {

//        $id='auth'::id();
//        $favourites=Favourite::where('user_id',$id)->paginate(5);
//        return view('favourites.index')->with('favourites', $favourites);
    }

   
    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|min:10|max:255']);
        
        $favourite = new Favourite;
        $favourite->name = $request->name;
        $favourite->book_id = $request->book_id;
        $favourite->user_id=$request->user_id;

        if(Favourite::find()->all()>where())

        $favourite->save();

        Session::flash('success', 'New book has been sucessfully added to your Favourites .');

        return redirect()->route('favourites.index');
    }

   
    public function show(favourite $favourite)
    {
        //
    }

    
    public function edit(favourite $favourite)
    {
         $this->authorize('update', $favourite);
        $favourite = Favourite::find($favourite->id);
        return view('favourites.update')->with('favourites', $favourite);
    }

  
    public function update(Request $request, favourite $favourite)
    {
         $this->authorize('update', $favourite);
        $favourites= Favourite::all();
       
        $favourite = Favourite::find($favourite->id);
        $favourite->name = $request->name;
        $favourite->book_id = $request->book_id;
         $favourite->user_id=$request->user_id;
        $favourite->save();
        return redirect()->route('favourites.index');
       
        }
    

   
    public function destroy($id)
    {

         $favourite = Favourite::find($id);

         $favourite->delete();
        
        return redirect()->route('favourites.index');
    }




    
}
