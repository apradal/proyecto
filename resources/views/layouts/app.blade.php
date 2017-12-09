<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Activeko</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        @include('includes.loginPanel')
        @include('includes.loginForm')
        @yield('content')
        <script src="{{ asset('js/myJs.js') }}"></script>
    </body>
</html>