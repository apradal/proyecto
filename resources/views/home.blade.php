@extends('layouts.app')

@include('includes.registerForm')

@section('content')

    <h1>Contenido principal de la página</h1>

    @include('includes.filterBar')
    <ul id="activities">
    @include('includes.activities')
    </ul>

    @if(session('message'))
        {{--aqui quiero poner una x de icono y con css aparecera en medio y se podra cerrar--}}
        {{--saca el mensaje activdad creada--}}
        <div id="message">{{session('message')}}</div>
    @endif

    @include('includes.joinActivity')
    @include('includes.leaveActivity')

@endsection