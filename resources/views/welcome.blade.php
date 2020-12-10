@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center bg-dark text-uppercase"><h2 class="mb-0" style="color:white;">WELCOME TO {{ config('app.name', 'Laravel') }}</h2></div>

                    <div class="card-body text-center">
                        <a href="/home"><img src="{{asset('img/task-fighter.png')}}" alt="Moose" class="w-100"></a>

                        <a href="/home" class="btn btn-success btn-lg mt-5">Enter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection