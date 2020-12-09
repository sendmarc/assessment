@extends('layouts.dashboard')

@section('content')

    <div class="py-4 rounded box-shadow">

        <tasks tasks="{{ json_encode($tasks) }}"></tasks>

    </div>
@endsection