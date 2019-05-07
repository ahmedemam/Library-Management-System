@extends('layouts.app')
@section('content')
    {{-- header --}}
    <div class="text-center mb-5">
        <h1>Update Book</h1>
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

    {{-- Updating Section --}}
    <section>
        <form action="{{route('books.update', [$editedBook->id])}}" method=POST>
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            {{-- title --}}
            <div class="form-group row">
                <label class="col-sm-2" for="title">Book Title</label>
                <div class="col-sm-8">
                    <input type="text" name="updatedTitle" value="{{$editedBook->title}}" class="form-control"/>
                </div>
            </div>
            {{-- description --}}
            <div class="form-group row">
                <label class="col-sm-2" for="description">Book Description</label>
                <div class="col-sm-8">
                    <input type="text" name="updatedDescription" value="{{$editedBook->description}}"
                           class="form-control"/>
                </div>
            </div>
            {{-- author --}}
            <div class="form-group row">
                <label class="col-sm-2" for="author">Book Author</label>
                <div class="col-sm-8">
                    <input type="text" name="updatedAuthor" value="{{$editedBook->author}}" class="form-control"/>
                </div>
            </div>
            {{-- image --}}
            {{-- <div class="form-group row">
              <label class="col-sm-2" for="image">Book image</label>
              <div class="col-sm-8">
                <input type="file" name="updatedImage" value="{{$editedBook->image}}" class="form-control" />
              </div>
            </div> --}}
            {{-- category --}}
            @if (count($allCategories) > 0)
                <div class="form-group row">
                    <label class="col-sm-2" for="image">Book Category</label>
                    <div class="col-sm-8">
                        <select name="updatedCategoryId" value="{{$editedBook->category_id}}">
                            @foreach ($allCategories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            {{-- copies number --}}
            <div class="form-group row">
                <label class="col-sm-2" for="copies">Number of Copies</label>
                <div class="col-sm-8">
                    <input type="number" min="0" name="updatedCopiesNumber"
                           value="{{number_format($editedBook->copiesNumber)}}"
                           class="form-control"/>
                </div>
            </div>
            {{-- lease fee --}}
            <div class="form-group row">
                <label class="col-sm-2" for="leaseFee">Lease Fee</label>
                <div class="col-sm-8">
                    <input type="number" min="0" name="updatedLeaseFee" value="{{$editedBook->leaseFee}}"
                           class="form-control"/>
                </div>
            </div>
            {{-- submit --}}
            <div class="form-group text-center mt-5 row justify-content-around">
                <button type="submit" class="btn btn-success">Save Changes</button>
                <a href="{{route('books.index')}}" class="btn btn-info">Go Back</a>
            </div>
        </form>
    </section>
@endsection
