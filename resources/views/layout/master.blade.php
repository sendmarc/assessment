<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Task Fighter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css">


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <main id="content" class="p-4 p-md-5 pt-5">
        <div class="display-messages">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <span class="fa fa-times-circle fa-2x" ></span><strong> - Ooops !</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success"><span class="fa fa-check-circle fa-2x"></span><em style="vertical-align: text-bottom;"> {!! \Session::get('success'); !!}</em></div>
            @endif
            @if (\Session::has('warning'))
                <div class="alert alert-warning"><span class="fa fa-info-circle fa-2x"></span><em style="vertical-align: text-bottom;"> {!! \Session::get('warning'); !!}</em></div>
            @endif
            @if (\Session::has('info'))
                <div class="alert alert-info"><span class="fa fa-info-circle fa-2x"></span><em style="vertical-align: text-bottom;"> {!! \Session::get('info'); !!}</em></div>
            @endif

        </div>
        @yield('content')
        @yield('footer')
    </main>
    </body>
</html>
