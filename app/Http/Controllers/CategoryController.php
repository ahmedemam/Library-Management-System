<?php

namespace App\Http\Controllers;
use App\Category;
use App\Book;
use App\LeasedBook;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $categories=Category::orderBy('created_at')->paginate(10);
       return view('category.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('layouts.layout');
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required'
        ]);
        $category=new Category;
        $category->name=$request->input('name');
        $category->details=$request->input('details');
        $category->save();
        return redirect()->route('books.index')->with('success','category created succesfly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category=Category::find($id);
        return view('category.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required'
        ]);
        $category=Category::find($id);
        $category->name=$request->input('name');
        $category->details=$request->input('details');
        $category->save();
        return redirect()->route('books.index')->with('success','category updated succesfly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('books.index')->with('success','category deleted succesfly');
    }
    
    public function getallbooks($id)
    {
        //
        $category=Category::find($id);
        // $category->delete();
        $match=['category_id' => $id];
        $books=Book::where($match)->get();

        return view('category.categorybooks')->with(['category'=>$category,'storedBooks'=>$books]);
    }
       
    public function leasebooks($id,$user_id)
    {
        //
        $book = Book::find($id);
      if($book->copiesNumber>0)
      {
        $book->copiesNumber =$book->copiesNumber - 1 ;
        $book->save();
        $leasedbook=new LeasedBook ;

        // $category->delete();
       $leasedbook->user_id=$user_id;
       $leasedbook->book_id=$id;
       $leasedbook->save();
       return redirect()->route('books.index');
      }
      else
      {
        return redirect()->route('books.index')->with('error','sorry all copies are leased');
      }
    
    }
    
}
