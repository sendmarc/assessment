<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task List</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div id="app">
                <router-view></router-view>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('/js/app.js') }}"></script>
</html>
