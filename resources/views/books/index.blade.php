@extends('layouts.app')
@section('content')

{{-- header --}}
<div class="text-center mb-5">
  <h1>Show all Books</h1>
</div>

{{-- add & sort buttons --}}
<div class="d-flex justify-content-between col-sm-9 offset-md-3">
  <a href="{{route('books.create')}}" class="btn btn-success">ADD New Book</a>
  <div>
    <p class="mt-2 mb-0 mr-3 d-inline">Order By:</p>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="{{route('books.index')}}" class="btn btn-secondary">All</a>
      <a href="{{route('books.rate')}}" class="btn btn-secondary">Rate</a>
      <a href="{{route('books.latest')}}" class="btn btn-secondary">Latest</a>
    </div>
  </div>
</div>
<!-- display Books -->
<section class="mt-3">
  <div class="row">
    {{-- categories --}}
    <div class="col-sm-3">
      @if (count($allCategories) > 0)
      <ul class="list-unstyled">
        @foreach ($allCategories as $category)
        <li class="my-3">
          <a href="{{url('/category/getall', [$category->id])}}">{{$category->name}}</a>
        </li>
        @endforeach
      </ul>
      @endif
    </div>

    {{-- books --}}
    <div class="col-sm-9">
      <div class="row">
        @if (count($storedBooks) > 0)
        @foreach ($storedBooks as $book) {{-- each-book --}}
        <div class="col-md-4 col-sm-6">
          <div class="each-book mb-3">
            <div class="card">
              <img src="/storage/book_images/{{$book->image}}" class="card-img-top w-100" height="250"
                alt="{{$book->title}}">
              <div class="card-body">
                <h5 class="card-title">{{$book->title}}</h5>
                <p class="card-text">{{str_limit($book->description, 75)}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="m-0">{{number_format($book->copiesNumber)}} copies available</p>
                  <form action="{{route('favourites.store')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value={{Auth::id()}} name="user_id">

                    <input type="hidden" value={{$book->id}} name="book_id">
                    <button type="submit" class="btn btn-danger">Fav</button>
                  </form>
                </div>
                <div>
                  <a href="{{route('books.show', ['chosenBook'=> $book->id])}}" class="btn btn-primary w-100 mt-3">Go
                    To Book Page</a>
                </div>
                <div class="d-flex justify-content-around mt-3">
                  <a href="{{route('books.edit', ['editedBook'=> $book->id])}}" class="btn btn-info">Update</a>
                  <form action="{{route('books.destroy', ['books' => $book->id])}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </div>
                <div>
                  <a class="btn btn-success w-100 mt-3"
                    href="{{url('/books/lease', [$book->id,Auth::user()->id])}}">Lease</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @else
        <h1> No Books in The Library </h1>
        @endif
      </div>
      {{-- ./row --}}
      {{-- pagination --}}
      <div class="text-center mt-5">
        <div class="d-inline-block">
          {{$storedBooks->links()}}
        </div>
      </div>
    </div>
    {{-- ./books --}}
</section>
@endsection