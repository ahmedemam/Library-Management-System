@extends('layouts.app') 
@section('content')

<div class="container">
  {{-- header --}}
  <div class="text-center mb-5">
    <h1>All Favourites</h1>
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
          @if (count($favouriteBooks) > 0) @foreach ($favouriteBooks as $book) {{-- each-book --}}
          <div class="col-md-4 col-sm-6">
            <div class="each-book mb-3">
              <div class="card">
                <img src="/storage/book_images/{{$book->id}}" class="card-img-top w-100" height="250" alt="{{$book->title}}">
                <div class="card-body">
                  <h5 class="card-title">{{$book->title}}</h5>
                  <p class="card-text">{{str_limit($book->description, 75)}}</p>
                
                 
                  <div class="d-flex justify-content-around mt-3">
                  
                    {!!Form::open(['action'=>['FavouriteController@destroy',$book->id],'method'=>'POST','class'=>'pull0right'])!!}

    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}


    {!!Form::close()!!}

                  </div>
                 
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