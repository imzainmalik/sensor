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

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
