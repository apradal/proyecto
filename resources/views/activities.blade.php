@extends('layouts.app')

@section('content')
    <div id="container">
        <div class="errors">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="success"></div>
        @if(Auth::check())
            @include('includes.editActivity')
            @include('includes.users')
            @include('includes.deleteActivity')
        @else
            <h2>Ops!!! no se como ha llegado hasta aquí.</h2>
            <p>No se lo cuente a nuestros jefes, algunos desarrolladores llevan días sin comer</p>
        @endif
    </div>
@endsection