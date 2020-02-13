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
                <div class="pull-left"><h1>Listing all tasks</h1></div>
                <div class="pull-right" style="padding-top: 20px"><a id="ticking" class="btn btn-primary" href="list/tick">Click to tick</a></div>
            </div>
            <div class="row">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
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

        <script>
            $('ticking').click(function(e){
                e.preventDefault(); // Prevents default link action
                $.ajax({
                    url: $(this).attr('href'),
                    success: function(data){
                    // Do something
                    console.log('ticked');
                    }
                });
            });

            function tick() {             
                console.log('ticked');
            }
        </script>

    </body>
    
</html>