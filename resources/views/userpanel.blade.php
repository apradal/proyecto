<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>userpanel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        //TO DO, panel usuario con listado para mostrar datos, actividades activas y finalizadas.
        <a class="logo" href="{{ url('/')}}"><h3>Logo de vuelta</h3></a>
        @if (Auth::check())
            {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
            {{Form::submit('Log Out')}}
            {!! Form::close() !!}
            <div id="izq">
                <ul>
                    <li><a href="#">Datos Personales</a></li>
                    <li><a href="#">Registro de Actividades</a></li>
                </ul>
            </div>
            <div id="content">
                <h1>Contenido de usuario</h1>
                @include('includes.personalData')
                @include('includes.activitiesUser')
            </div>
        @else
            <h1>Ops! no deberías de estar aquí!!!</h1>
        @endif
        <script src="{{ asset('js/userJs.js') }}"></script>
    </body>
</html>