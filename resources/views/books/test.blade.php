<section class="mt-3">
    <div class="col-md-12">
      @if (count($storedBooks) > 0)
      <table class="table text-center">
        {{-- table header --}}
        <thead>
          <th>#</th>
          <th>Image</th>
          <th>Title</th>
          <th>Description</th>
          <th>Author</th>
          <th>Copies</th>
          <th>Lease Fee</th>
          <th>Rating</th>
          <th>Update</th>
          <th>Delete</th>
        </thead>
        {{-- table data --}}
        <tbody>
          @foreach ($storedBooks as $book)
          <tr>
            <th>{{$book->id}}</th>
            <th>{{$book->image}}</th>
            <th>{{$book->title}}</th>
            <th>{{$book->description}}</th>
            <th>{{$book->author}}</th>
            <th>{{number_format($book->copiesNumber)}}</th>
            <th>{{$book->leaseFee}}</th>
            <th>{{$book->rate}}</th>
            <th>
              <a href="{{route('books.edit', ['editedBook'=> $book->id])}}" class="btn btn-info">Update</a>
            </th>
            <th>
              <form action="{{route('books.destroy', ['books' => $book->id])}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </section>