@extends('layout.master')
@section('content')

        <div id="app">
            <div class="card">
            <tasks homed-route="{{ route('tasks') }}"></tasks>
            </div>

            <div class="card-footer">
                <div class="btn btn-danger">Back</div>
            </div>
        </div>


@endsection


