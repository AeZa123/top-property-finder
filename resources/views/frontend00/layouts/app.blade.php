<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontend.inc.header')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @include('frontend.inc.link')

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="hold-transition layout-top-nav" style="background-color: #ebf6ff">

    <div class="wrapper">

        {{-- @include('frontend.inc.navbar') --}}
        @if(request()->path() !== 'login' && request()->path() !== 'register')
            @include('frontend.inc.navbar')
        @endif

        {{-- @yield('carousel') --}}
        @yield('content')
    
     
        @include('frontend.inc.script')
    </div>

    

</body>

</html>
