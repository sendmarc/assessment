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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
