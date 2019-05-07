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
<div class="row mt-3">
	@if(count($categories)>=1)
	@foreach($categories as $category)
	<div class="col-lg-3 col-md-4 col-sm-6">
		<div class="each-book mb-3">
			<div class="card">
				<div class="card-body">
					<h5>{{$category->name}}</h5>
					<p>{{$category->details}}</p>
					<div class="d-flex justify-content-around">
						<a class="btn btn-primary" href="/category/{{$category->id}}/edit"> Edit</a>
						{!!Form::open(['action'=>['CategoryController@destroy',$category->id],'method'=>'POST','class'=>'pull0right'])!!}
						{{Form::hidden('_method','DELETE')}}
						{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@else
	<p> no category found</p>
	@endif
</div>

@endsection