@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr><td>Name</td><td>Priority</td><td>Due In</td><td>Action</td></tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->dueIn }}</td>
                            <td><div class="btn">tick</div></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>


        </div>
    </div>
    <div class="card-footer">
        <div class="btn btn-danger">Back</div>
    </div>

@endsection


