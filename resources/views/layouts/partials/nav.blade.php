<nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-dark fixed-top">

    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/logo.png')}}" alt="Site Logo">
    </a>
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav navbar-nav-left mr-auto">
        <li class="text-white"><strong>{{ config('app.name', 'Laravel') }}</strong></li>
    </ul>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseSidebar"
            aria-controls="collapseSidebar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <i class="fas fa-bars color-white" style="cursor:pointer;"></i>
    </button>
</nav>