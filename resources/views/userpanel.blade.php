<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>userpanel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <a class="logo" href="{{ url('/')}}"><h3>Logo de vuelta</h3></a>
        @if (Auth::check())
            {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
            {{Form::submit('Log Out')}}
            {!! Form::close() !!}
            <div id="izq">
                <ul class="userpaneloptions">
                    <li id="dataOption">Datos Personales</li>
                    <li id="activitiesOption">Registro de Actividades</li>
                </ul>
            </div>
            <div id="content">
                <h1>Contenido de usuario</h1>
                @include('includes.personalData')
                @include('includes.activitiesUser')
                @include('includes.leaveActivity')
            </div>
        @else
            <h1>Ops! no deberías de estar aquí!!!</h1>
        @endif
        <script src="{{ asset('js/userJs.js') }}"></script>
    </body>
</html>