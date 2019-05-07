@extends('layouts.app')
@section('content')

    <main class="container">

        {{-- book data --}}
        <section class="row">
            <div class="col-sm-8">
                <div class="media">
                    {{-- /storage/book_images/ --}}
                    <img src="/storage/book_images/{{$book->image}}" class="mr-3" alt="{{$book->title}}" width="200"
                         height="350">
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


            <div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
                <form action="{{ route('comments.store')}}" method='POST'>
                    <form action="{{ route('comments.store')}}" method='POST'>
                        {{ csrf_field() }}
                        <input type="text" name='review' class='form-control'>
                        <input type="number" name='rate' class='form-control'>
                        <input type="hidden" name='book_id' value="{{$book->id}}">
                        <input type="submit" class='btn btn-danger' value='Add Comment'>
                    </form>


            </div>


            {{-- display stored book comments --}}
            @if (count($storedComments ) > 0)
                <table class="table">
                    <thead>

                    <th>User</th>
                    <th>comment</th>
                    <th>Rate</th>
                    <th>Delete</th>
                    </thead>

                    <tbody>
                    @foreach ($storedComments as $storedComment)
                        <tr>
                            <th>{{ $storedComment->user->name }}</th>
                            <td>{{ $storedComment->review }}</td>
                            <td>{{ $storedComment->rate }}</td>
                            <td>
                                @can('delete', $storedComment)
                                    <form action="{{ route('comments.destroy', ['reviews'=>$storedComment->id]) }}"
                                    <form action="{{ route('comments.destroy', ['reviews'=>$storedComment->id]) }}"
                                          method='POST'>
                                        {{ csrf_field() }}

                                        <input type="hidden" name='_method' value='DELETE'>

                                        <input type="submit" class='btn btn-danger' value='Delete'>
                                    </form>

                                @endcan

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif


        </section>

        {{-- related Books --}}
        <section>

        </section>

    </main>
@endsection
