@extends('layouts.app') 
@section('content')

<div class="container">
  {{-- header --}}
  <div class="text-center mb-5">
    <h1>Show all Leased</h1>
  </div>

     
  
  <!-- display Books -->
  <section class="mt-3">
    <div class="row">
      {{-- categories --}}
      <div class="col-sm-3">
       
      </div>

      {{-- books --}}
      <div class="col-sm-9">
        <div class="row">
          @if (count($leasedBooks) > 0) @foreach ($leasedBooks as $book) {{-- each-book --}}
          <div class="col-md-4 col-sm-6">
            <div class="each-book mb-3">
              <div class="card">
                <img src="/storage/book_images/{{$book->id}}" class="card-img-top w-100" height="250" alt="{{$book->title}}">
                <div class="card-body">
                  <h5 class="card-title">{{$book->title}}</h5>
                  <p class="card-text">{{str_limit($book->description, 75)}}</p>
                
                 
     
                  
                </div>
              </div>
            </div>
          </div>
          @endforeach @endif
        </div>
      </div>
      {{-- ./books --}}
    </div>
   
      <div class="text-center mt-5">
      <div class="d-inline-block">
        {{-- {{$favouriteBooks->links()}} --}}
      </div>
    </div>
  </section>
</div>
@endsection