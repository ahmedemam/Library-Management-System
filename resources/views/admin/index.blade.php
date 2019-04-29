@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.create') }}"> Create New Contact</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>National ID</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td><img src="{{ $user->image }}" alt="user image"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->national_id }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <form action="{{ route('admin.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('admin.show',$user->id) }}">Show</a>
                        @can('update',$user)
                            <a class="btn btn-primary" href="{{ route('admin.edit',$user->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
