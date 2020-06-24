<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TaskFighter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Montserrat&display=swap" rel="stylesheet">

    <!-- Webpack JS -->
    <script src="{{ URL::asset('js/app.js') }}" defer></script>

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
            height: 47px;
        }

        thead {
            background-color: #fff;
            color: #4e4e4e;
            top: 50px;
            position: sticky;
            position: -webkit-sticky;
            border-bottom: 2px solid #5f5f5f;
        }


        .title {
            text-align: left;
            font-family: 'Lobster', cursive;
            font-size: 30px;
            padding-left: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .title img {
            margin-left: 10px;
            height: 25px;
            outline: 2px solid #acacac;
            outline-offset: 0px;
        }

        .title img:hover {
            outline: 2px solid #000;
            outline-offset: 0px;
        }

        td img {
            margin-left: 10px;
            height: 25px;
        }

        td img:hover {
            outline: 2px solid #acacac;
            outline-offset: 0px;
        }
    </style>
</head>

<body>
    <div class="header position-sticky">
        <div class="title m-b-md">
            TaskFighter
            <img id='ticker' src="{{asset('storage/tick.png')}}" v-on:click="tick" />
        </div>
    </div>
    <table>
        <thead>
            <tr id='table-header'>
                <th id='th-name'>Task Name</th>
                <th id='th-due'>Due In (days)</th>
                <th id='th-prio'>Priority</th>
                <th>Complete</th>
            </tr>
        </thead>
        <tbody id='table-body'>

            @foreach($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>{{$task->dueIn}}</td>
                <td>{{$task->priority}}</td>
                <td><img v-on:click='complete({{$task->id}})' src="{{asset('storage/complete.png')}}" /></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>