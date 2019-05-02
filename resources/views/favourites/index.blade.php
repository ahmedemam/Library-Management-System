 
@extends('layouts.app')

  @section('index')
      
        <form action="{{ route('favourite.store') }}" method="POST">
        {{ csrf_field() }}
          <div class="form-row">
            <div class="col">
              <input type="text" name="name" value="drama" class="form-control"/>
              <input type="hidden" name="user_id" value={{Auth::id()}} class="form-control"/>
             <input type="hidden" name="book_id" value='1' class="form-control"/>

            </div>
            <div class="col">
              <button type="submit" class="btn btn-success">Add Book</button>
               <ul>
                    @foreach ($favourites as $favourite )

               <li> {{$favourite->id}}</li>
                        
                    @endforeach

               </ul>
            </div>
          
          </div>
        </form>
      </div>
      <!-- display favourites -->
      {{-- <div class="col-md-8 offset-md-2">
        @if (count($storedfavourites) > 0)
          <table class="table">
            <thead>
              <th>#</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Update</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach ($storedfavourites as $contact)
              <tr>
                <th>{{$contact->id}}</th>
                <th>{{$contact->name}}</th>
                <th>{{$contact->contact}}</th>
               @if(count($storedfavourites)>2)
                  <th>

                  <a href="{{route('favourites.edit', ['favourites'=> $contact->id])}}" class="btn btn-info">Update</a>
                </th>
                <th>
                  <form action="{{route('favourites.destroy', ['favourites' => $contact->id])}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>

               
                @endif
               
                  </form>
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div> --}}
      @endsection


  