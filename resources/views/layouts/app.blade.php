@include('layouts.partials.head')

<body class="welcome">
<div class="mt-5">

    @include('layouts.partials.nav')

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
