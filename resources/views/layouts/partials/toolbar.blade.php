<div class="d-xl-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">{{ $title }}</h1>

    <div class="btn-toolbar mb-0 justify-content-between">

        <div class="btn-group btn-group-sm" role="group" aria-label="Toolbar 1">
            @yield('toolbar-1')
        </div>

        <div class="btn-group btn-group-sm" role="group" aria-label="Toolbar 2">
            @yield('toolbar-2')
        </div>

    </div>
</div>

@if ($flash = session('message'))

    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $flash }}
    </div>

@endif
