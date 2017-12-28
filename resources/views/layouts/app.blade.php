<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Activeko</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <div id="modal-bg"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 no-padding">
                    <div id="header">
                        @include('includes.loginPanel')
                        @include('includes.loginForm')
                    </div>
                </div>
            </div>
        @yield('content')
        @include('includes.footer')
        <script src="{{ asset('js/myJs.js') }}"></script>
    </body>
</html>