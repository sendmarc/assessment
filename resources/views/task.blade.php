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

        .active {
            color: #000;
            background-color: #ececec;
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
    <div id="app">
        <div class="header position-sticky">
            <div class="title m-b-md">
                TaskFighter
                <img src="{{asset('storage/tick.png')}}" v-on:click="tick" />
            </div>
        </div>
        <table>
            <thead>
                <tr id='table-header'>
                    <th v-on:click='sort("name")' id='th-name' v-bind:class="[ currentSort == 'name'? 'active':'' ]">Task Name</th>
                    <th v-on:click='sort("dueIn")' id='th-duein' v-bind:class="[ currentSort == 'dueIn'? 'active':'' ]">Due In (days)</th>
                    <th v-on:click='sort("priority")' id='th-priority' v-bind:class="[ currentSort == 'priority'? 'active':'' ]">Priority</th>
                    <th>Complete</th>
                </tr>
            </thead>
            <tbody id='table-body'>
                <tr v-for="task in sortedTasks">
                    <td>@{{task.name}}</td>
                    <td>@{{task.dueIn}}</td>
                    <td>@{{task.priority}}</td>
                    <td>
                        <img v-on:click="complete" v-bind:id="'complete-' + task.id" src="{{asset('storage/complete.png')}}" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>