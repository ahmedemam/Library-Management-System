@extends('layouts.app') 
@section('content')

<main class="container">

  {{-- book data --}}
  <section class="row">
    <div class="col-sm-8">
      <div class="media">
        <img src="/storage/book_images/{{$book->image}}" class="mr-3" alt="{{$book->title}}" width="200" height="350">
        <div class="media-body">
          <h5 class="mt-0">{{$book->title}}</h5>
          <p>
            {{$book->description}}
          </p>
          <p class="m-0">{{number_format($book->copiesNumber)}} copies available</p>
          <div>
            <button class="btn btn-success mt-3">Lease</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
     <form action="{{route('favourites.store')}}" method="POST">
                      {{ csrf_field() }}
                     <input type="hidden" value={{Auth::id()}} name="user_id">

                      <input type="hidden" value={{$book->id}} name="book_id">
                      <button type="submit" class="btn btn-danger">Fav</button>
                    </form>
    </div>
  </section>

  {{-- comments --}}
  <section>

  </section>

  {{-- related Books --}}
  <section>

  </section>
  
</main>
@endsection