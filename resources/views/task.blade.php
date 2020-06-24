<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Montserrat', sans-serif;
            font-weight: 200;
            margin: 0;
        }


        .header {
            background-color: #fff;
            align-items: top;
            justify-content: center;
            border-bottom: 3px solid #4E4E4E;
            top: 0;
            position: sticky;
            position: -webkit-sticky;
            height: 50px;
        }

        thead tr {
            background-color: #fff;
            top: 53px;
            position: sticky;
            position: -webkit-sticky;
            border-bottom: 1px solid #5f5f5f;
        }


        .title {
            text-align: left;
            font-family: 'Lobster', cursive;
            font-size: 30px;
            padding-left: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        img {
            margin-left: 10px;
            height: 25px;
            outline: 2px solid #acacac;
            outline-offset: 0px;
        }

        img:hover {
            outline: 2px solid #000;
            outline-offset: 0px;
        }
    </style>
</head>

<body>
    <div class="header position-sticky">
        <div class="title m-b-md">
            TaskFighter
            <img src="{{asset('storage/tick.png')}}" />
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Due In (days)</th>
                <th>Priority</th>
                <th>Complete</th>
            </tr>
        </thead>
        <tbody>

            @foreach($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>{{$task->dueIn}}</td>
                <td>{{$task->priority}}</td>
                <td><img src="{{asset('storage/complete.png')}}" /></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>