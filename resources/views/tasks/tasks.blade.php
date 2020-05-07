@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>

        <div class="card-body">
            <div>
                <a class="btn btn-primary" href="{{ URL::to('list/tick/') }}"><i class="fas fa-check"></i></a>
            </div>

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
                            <td>
                                <form method="POST" action="/tasks/{{$task->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger delete-user" value="Delete">
                                    </div>
                                </form>
                            </td>
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


