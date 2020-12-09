@include('layouts.partials.head')

<body class="dashboard dashboard">

@include('layouts.partials.loader')
@include('layouts.partials.nav')
@include('layouts.partials.sidebar')
<main role="main" class="col-lg-10 col-md-9 col-xs-12 ml-sm-auto px-4 pb-5">

    @include('layouts.partials.toolbar')

    <div id="app">
        @yield('content')
    </div>

    <footer class="mt-3">
        <p>&copy; {{env('APP_NAME')}} {{ now()->year }}</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    @yield('page-script')

</main>
</body>
</html>
