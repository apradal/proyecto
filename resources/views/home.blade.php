@extends('layouts.app')

@section('content')

    <h1>Contenido principal de la página</h1>

    @if(session('message'))
        {{--aqui quiero poner una x de icono y con css aparecera en medio y se podra cerrar--}}
        <div id="message">{{session('message')}}</div>
    @endif

@endsection