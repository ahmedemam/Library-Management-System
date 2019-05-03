<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    //! all books
    public function index()
    {
        // $books = Book::all()->paginate(3);
        $books = Book::orderBy('id')->paginate(6);
        $categories = Category::all();
        return view('books.index')->with(['storedBooks' => $books, 'allCategories' => $categories]);
        // return view('booksList', ['books' => $books]);
    }

    //! all books by latest
    public function getLatest()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::all();
        return view('books.index')->with(['storedBooks' => $books, 'allCategories' => $categories]);
    }

    //! all books by latest
    public function getHighRated()
    {
        $books = Book::orderBy('rate', 'desc')->paginate(6);
        $categories = Category::all();
        return view('books.index')->with(['storedBooks' => $books, 'allCategories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create')->with(['allCategories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bookTitle' => 'required|min:2|max:255',
            'bookDescription' => 'required|min:2',
            'bookAuthor' => 'required|min:2|max:255',
            'leaseFee' => 'required|numeric',
            'bookImage' => 'image|nullable|max:1999',
        ]);

        //! handle file upload
        if ($request->hasFile('bookImage')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('bookImage')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('bookImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload Image
            $path = $request->file('bookImage')->storeAs('public/book_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $book = new book;
        $book->title = $request->bookTitle;
        $book->description = $request->bookDescription;
        $book->author = $request->bookAuthor;
        $book->image = $fileNameToStore;
        $book->copiesNumber = $request->copiesNumber;
        $book->leaseFee = $request->leaseFee;
        $book->category_id = $request->categoryId;
        // $book->rate = $request->bookRate;
        $book->save();
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //! single book
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.book')->with(['book' => $book]);
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
        $categories = Category::all();
        return view('books.update')->with(['editedBook' => $book, 'allCategories' => $categories]);
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
        $this->validate($request, [
            'updatedTitle' => 'required|min:2|max:255',
            'updatedDescription' => 'required|min:2',
            'updatedAuthor' => 'required|min:2|max:255',
            'updatedLeaseFee' => 'required|numeric',
            'bookImage' => 'image|nullable|max:1999',
        ]);

        //! handle file upload
        if ($request->hasFile('bookImage')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('bookImage')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('bookImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload Image
            $path = $request->file('bookImage')->storeAs('public/book_images', $fileNameToStore);
        }

        $book = Book::find($id);
        $book->title = $request->updatedTitle;
        $book->description = $request->updatedDescription;
        $book->author = $request->updatedAuthor;
        if ($request->hasFile('bookImage')) {
            $book->image = $fileNameToStore;
        }
        $book->copiesNumber = $request->updatedCopiesNumber;
        $book->leaseFee = $request->updatedLeaseFee;
        $book->category_id = $request->updatedCategoryId;
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
        $book = Book::find($id)->delete();
        // if (Book::find($id)->image != 'noimage.jpg') {
        //     Storage::delete('public/book_images/' . Book::find($id)->image);
        // }
        return redirect()->route('books.index');
    }
}
