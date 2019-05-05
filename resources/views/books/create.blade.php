@extends('layouts.app') 
@section('content')
  {{-- header --}}
  <div class="text-center mb-5">
    <h1>Add New Book to The Library</h1>
  </div>

  <!-- display success msg -->
  @if(Session::has('success'))
  <div class="alert alert-success">
    <strong>Great: </strong> {{Session::get('success')}}
  </div>
  @endif

  <!-- display errors -->
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>ERORR:</strong>
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif 
  

  @if (count($allCategories) > 0)
  {{-- Adding new Book Section --}}
  <section>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} 
      {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}} 
      {{-- title --}}
      <div class="form-group row">
        <label class="col-sm-2" for="title">Book Title</label>
        <div class="col-sm-8">
          <input type="text" name="bookTitle" class="form-control" />
        </div>
      </div>
      {{-- description --}}
      <div class="form-group row">
        <label class="col-sm-2" for="description">Book Description</label>
        <div class="col-sm-8">
          <input type="text" name="bookDescription" class="form-control" />
        </div>
      </div>
      {{-- author --}}
      <div class="form-group row">
        <label class="col-sm-2" for="author">Book Author</label>
        <div class="col-sm-8">
          <input type="text" name="bookAuthor" class="form-control" />
        </div>
      </div>
      {{-- image --}}
      <div class="form-group row">
        <label class="col-sm-2" for="image">Book image</label>
        <div class="col-sm-8">
          <input type="file" name="bookImage" class="form-control" />
        </div>
      </div>
      {{-- category --}} 
      
      <div class="form-group row">
        <label class="col-sm-2" for="image">Book Category</label>
        <div class="col-sm-8">
          <select name="categoryId">
          @foreach ($allCategories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
        </div>
      </div>
      
      {{-- copies number --}}
      <div class="form-group row">
        <label class="col-sm-2" for="copies">Number of Copies</label>
        <div class="col-sm-8">
          <input type="number" min="0" name="copiesNumber" class="form-control" />
        </div>
      </div>
      {{-- lease fee --}}
      <div class="form-group row">
        <label class="col-sm-2" for="leaseFee">Lease Fee</label>
        <div class="col-sm-8">
          <input type="number" min="0" name="leaseFee" class="form-control" />
        </div>
      </div>
      {{-- submit --}}
      <div class="col text-center">
        <button type="submit" class="btn btn-success">Add Book</button>
      </div>
    </form>
    @else
    <h4>You Need To create a new category</h4>
    <a class="btn btn-primary" href="{{ route('category.create') }}"> Create Category</a>
    @endif 
  </section>
@endsection