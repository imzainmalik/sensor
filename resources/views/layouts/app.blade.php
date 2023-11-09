<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.compatibility')
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.style')

</head>

<body>
    <div id="app">
        @include('includes.header')
        <section class="mmbody">
            <div class="container-fluid">
                <div class="row">
                    @if(Auth::check())
                    <div class="col-md-3 col-xl-2">
                        @include('includes/leftbar')
                    </div>
                    @endif

                    @yield('content')
                    @if(Auth::check())
                    <div class="col-md-3 col-xl-2">
                        @include ('includes/rightbar')
                    </div>
                    @endif
                </div>
            </div>
        </section>

        @include ('includes/scripts')
</body>

</html>
