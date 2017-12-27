<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<header class="container-fluid">
    <navbar id="userPanel">
        <a class="logo" href="{{ url('/')}}"><img src="{{ URL::to('/images/logo-mini.png') }}" alt="logo"></a>
        <span class="title">Activeko</span>
        <div id="user-options">
            @if (Auth::check() && Auth::user()->nombre == 'Admin' && Auth::id() === 3)
                {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
                <input type="submit" name="Log Out" value="Log Out" class="btn-form filled">
                {!! Form::close() !!}
        </div>
        <div class="clear"></div>
    </navbar>
</header>
<div id="container">
    <div class="row">
        <div id="izq" class="col-sm-2">
            <ul class="adminpanel-options">
                <li id="activities-option">Actividades</li>
                <li id="users-option">Usuarios</li>
            </ul>
        </div>
        <div id="content" class="col-sm-10">
            @include('includes.filterBarAdmin')
            @include('includes.filterBarUser')
            @if(session('message'))
                <div id="message" class="alert alert-success">{{session('message')}}</div>
            @endif
        </div>
    </div>
</div>
@else
    <div class="clear"></div>
    </navbar>
    </header>
    <div id="container">
        <div class="row">
            <div class="col"><h1>Ops! no deberías de estar aquí!!!</h1></div>
        </div>
    </div>
@endif
@include('includes/footer')
<script src="{{ asset('js/adminJs.js') }}"></script>
</body>
</html>