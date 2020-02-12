<html>
    <head>
        <title>Elisabeth Sendmarc Assessment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      </head>
    <body>      
        <div class="container">
            <div class="row">
                <h1>Listing all tasks</h1>
            </div>
            <div class="row">
                <table class="table">
                <tr><th><h3>Name</h3></th><th><h3>Priority</h3></th><th><h3>Due in (days)</h3></th></tr>
                @foreach($data as $task)
                    <tr>
                        <td>{{$task->name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>{{$task->dueIn}}</td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </body>
</html>