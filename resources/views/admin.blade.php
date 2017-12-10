<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>adminpanel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<a class="logo" href="{{ url('/')}}"><h3>Logo de vuelta</h3></a>
@if (Auth::check() && Auth::user()->nombre == 'Admin' && Auth::id() === 3)
    {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
    {{Form::submit('Log Out')}}
    {!! Form::close() !!}
    <div id="izq">
        <ul class="adminpanel-options">
            <li id="activities-option">Actividades</li>
            <li id="users-option">Usuarios</li>
        </ul>
    </div>
    <div id="content">
        <h1>Contenido de admin</h1>
        @if(session('message'))
            {{--aqui quiero poner una x de icono y con css aparecera en medio y se podra cerrar--}}
            {{--saca el mensaje activdad creada--}}
            <div id="message">{{session('message')}}</div>
        @endif
        <p>Desde este menú puede buscar, editar y eliminar actividades o usuarios.</p>
        @include('includes.filterBarAdmin')
        @include('includes.filterBarUser')
    </div>
@else
    <h1>Ops! no deberías de estar aquí!!!</h1>
@endif
<script src="{{ asset('js/adminJs.js') }}"></script>
</body>
</html>