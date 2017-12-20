@extends('layouts.app')
@section('content')
    <div id="container">
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" style="margin: 1% 0">{{ $error }}</div>
            @endforeach
        </div>
        @endif
        @if(Auth::check())
            @include('includes.editActivity')
            @include('includes.users')
            @include('includes.deleteActivity')
        @else
            <div class="container" style="text-align: center">
                <h2 class="title" style="margin-top: 5%">Ops!!! no se como ha llegado hasta aquí.</h2>
                <p>No se lo cuente a nuestros jefes, algunos desarrolladores llevan días sin comer</p>
            </div>
        @endif
    </div>
@endsection