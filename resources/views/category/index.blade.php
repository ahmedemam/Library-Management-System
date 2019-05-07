@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    @if (session('success'))
        <div class="alert alert-success">
            <strong>{{session('success')}}</strong>.<br><br>

        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            {{session('error')}}
        </div>
    @endif
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('category.create') }}"> Create Category</a>
    </div>
    @if(count($categories)>=1)
        @foreach($categories as $category)
            <div class="well">
                <h3>{{$category->name}}</h3>
                <h3>{{$category->details}}</h3>

                <a class="btn btn-primary" href="/category/{{$category->id}}/edit"> Edit</a>

                {!!Form::open(['action'=>['CategoryController@destroy',$category->id],'method'=>'POST','class'=>'pull0right'])!!}

                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}


                {!!Form::close()!!}

            </div>
        @endforeach
    @else
        <p> no category found</p>
    @endif
@endsection
