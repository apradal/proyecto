@extends('layouts.app')
@include('includes.registerForm')
@section('content')
    <div class="container-fluid">
        @include('includes.filterBar')
    </div>
    <div class="container">
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
    </div>
@endsection