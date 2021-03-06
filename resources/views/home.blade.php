@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('includes.filterBar')
        @if (!Auth::user())
            <div id="portada">
                <div class="messagePortada">
                    <h1>Crea la actividad que quieras, con cuantos tú quieras y donde sea!!!.</h1>
                </div>
            </div>
        @endif
    </div>
    <div class="container-fluid">
        @if(session('message'))
            <div id="message" class="alert alert-success">{{session('message')}}</div>
        @endif
        <ul id="activities">
            @include('includes.activities')
        </ul>
        @include('includes.joinActivity')
        @include('includes.leaveActivity')
        @include('includes.registerForm')
    </div>
@endsection