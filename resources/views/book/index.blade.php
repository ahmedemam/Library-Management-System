

<!DOCTYPE html>
<html lang="en">
<head>
   
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Book</title>
</head>
<body>
<div class="container">
  <div class="col-md-offset-2 col-md-8">
    <div class="row">
    @extends('layouts.app')
      <h1>Book details</h1>
    </div>

    {{-- display success message --}}
    @if (Session::has('success'))
      <div class="alert alert-success">
        <strong>Success:</strong> {{ Session::get('success') }}
      </div>
    @endif

    {{-- display error message --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Error:</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
      <form action="{{ route('reviews.store') }}" method='POST'>
      {{ csrf_field() }}

        <div class="col-md-10">
          <input type="text" name='review' class='form-control'>
        </div>

        <div class="col-md-10">
          <input type="text" name='rate' class='form-control'>
        </div>

        <div class="col-md-10">
          <input type="hidden" name='book_id' class='form-control'>
        </div>

        <div class="col-md-8">
          <input type="submit" class='btn btn-primary btn-block' value='Add Comment'>
        </div>
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
              <td>{{ $storedPhone->review }}</td>
              <td>{{ $storedPhone->rate }}</td>

                <form action="{{ route('reviews.destroy', ['reviews'=>$storedComment->id]) }}" method='POST'>
                  {{ csrf_field() }}
                  <input type="hidden" name='_method' value='DELETE'>

                  <input type="submit" class='btn btn-danger' value='Delete'>
                </form>
              </td>
              
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    <div class="row text-center">
      {{ $storedComments->links() }}
    </div>

  </div>
</div>
</body>
</html>