<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $books = Book::all();
        return view('admin/books.index')->with('storedBooks', $books);
        // return view('booksList', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['bookTitle' => 'required|min:2|max:255', 'bookDescription' => 'required|min:2', 'bookAuthor' => 'required|min:2|max:255', 'leaseFee' => 'required|numeric']);
        $book = new book;
        $book->title = $request->bookTitle;
        $book->description = $request->bookDescription;
        $book->author = $request->bookAuthor;
        $book->image = $request->bookImage;
        $book->copiesNumber = $request->copiesNumber;
        $book->leaseFee = $request->leaseFee;
        $book->rate = $request->bookRate;
        $book->save();
        return redirect()->route('home.index');
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
        $book = Book::find($id);
        return view('books.update')->with('editedBook', $book);
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
        $this->validate($request, ['updatedTitle' => 'required|min:2|max:255', 'updatedDescription' => 'required|min:2', 'updatedAuthor' => 'required|min:2|max:255', 'updatedLeaseFee' => 'required|numeric']);
        $book = Book::find($id);
        $book->title = $request->updatedTitle;
        $book->description = $request->updatedDescription;
        $book->author = $request->updatedAuthor;
        $book->leaseFee = $request->updatedLeaseFee;
        $book->save();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book = delete();
        return redirect()->route('books.index');
    }
}
