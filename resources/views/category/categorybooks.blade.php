
@extends('layouts.layout')
@section('content')
<h1>{{$category->name}} </h1>
<br/>
{{-- books --}}
      <div class="col-sm-9">
        <div class="row">
          @if (count($storedBooks) > 0) @foreach ($storedBooks as $book) {{-- each-book --}}
          <div class="col-md-4 col-sm-6">
            <div class="each-book mb-3">
              <div class="card">
                <img src="/storage/book_images/{{$book->image}}" class="card-img-top w-100" height="250" alt="{{$book->title}}">
                <div class="card-body">
                  <h5 class="card-title">{{$book->title}}</h5>
                  <p class="card-text">{{str_limit($book->description, 75)}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    
                    <p class="m-0">{{number_format($book->copiesNumber)}} copies available</p>
                    
                   
                  </div>
                 
                 
                </div>
              </div>
            </div>
          </div>
          @endforeach @endif
        </div>
      </div>
      {{-- ./books --}}
      @endsection