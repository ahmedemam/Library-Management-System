@extends('layouts.app')

@section('content')
<main style="height: 80vh">
    <div class="container">
        <div class="row justify-content-center" style="height: 80vh; align-items: center;">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                </div>
                @endif
                @yield('admin')
            </div>
        </div> --}}
        <p class="text-center" style="font-size: 50px">
            Welcome to our <br> Library Management System
        </p>
    </div>
    </div>
    </div>
</main>
@endsection