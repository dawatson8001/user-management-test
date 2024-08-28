<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
	    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, width=device-width, height=device-height, viewport-fit=cover">

        <title>{{env("APP_NAME") }} @if (isset($page_title)) - {{$page_title}} @endif</title>

        <!-- Favicon -->
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon.ico') }}" />
        
        <!-- Framework Imports -->
        <link type="text/css" href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">

        <!-- Main CSS Styling -->
        <!-- <link type="text/css" href="{{ asset('css/admin.css') }}" rel="stylesheet"> -->

        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!-- csrf token for ajax -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @vite(['resources/css/app.scss'])

        @yield('head')  

        @vite(['resources/js/app.js'])
    </head>
    <body class="antialiased">

        <div id="base-container" class="">
            @yield('content')
        </div>

    </body>
</html>