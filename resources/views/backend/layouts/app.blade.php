<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- @include('backend.inc.header') --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="_token" content="{{ csrf_token() }}"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @include('backend.inc.header')

    

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="background: #f4f6f9">

    <div class="wrapper">

        {{-- @include('frontend.inc.navbar') --}}
        {{-- @if (request()->path() !== 'login' && request()->path() !== 'register')
        @endif --}}
        @include('backend.inc.navbar')


        @include('backend.inc.sidebar')

        <div class="content-wrapper">
            <br>
            @yield('content')
        </div>

        {{-- @yield('carousel') --}}


        @include('backend.inc.footer')
    </div>




    @include('backend.inc.script')
</body>

</html>
