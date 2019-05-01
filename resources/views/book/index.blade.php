

<!DOCTYPE html>
<html lang="en">
<head>
   
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Contact List App</title>
</head>
<body>
<div class="container">
  <div class="col-md-offset-2 col-md-8">
    <div class="row">
    @extends('layouts.app')
      <h1>Contact List</h1>
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
      <form action="{{ route('phones.store') }}" method='POST'>
      {{ csrf_field() }}

        <div class="col-md-10">
          <input type="text" name='newPhoneName' class='form-control'>
        </div>

        <div class="col-md-10">
          <input type="text" name='number' class='form-control'>
        </div>

        <div class="col-md-10">
          <input type="hidden" name='user_id' value={{Auth::id()}} class='form-control'>
        </div>

        <div class="col-md-8">
          <input type="submit" class='btn btn-primary btn-block' value='Add Contact'>
        </div>
      </form>
    </div>

    {{-- display stored phones --}}
    @if (count($storedPhones) > 0)
      <table class="table">
        <thead>
          
          <th>Name</th>
          <th>Number</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>

        <tbody>
          @foreach ($storedPhones as $storedPhone)
            <tr>
              <th>{{ $storedPhone->name }}</th>
              <td>{{ $storedPhone->number }}</td>

              @if (count($storedPhones) > 2)
              <td><a href="{{ route('phones.edit', ['phones'=>$storedPhone->id]) }}" class='btn btn-default'>Edit</a></td>
              <td>
                <form action="{{ route('phones.destroy', ['phones'=>$storedPhone->id]) }}" method='POST'>
                  {{ csrf_field() }}
                  <input type="hidden" name='_method' value='DELETE'>

                  <input type="submit" class='btn btn-danger' value='Delete'>
                </form>
              </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    <div class="row text-center">
      {{ $storedPhones->links() }}
    </div>

  </div>
</div>
</body>
</html>