@extends('layouts.app')

@section('content')

    <h1>Contenido principal de la página</h1>

    @if(!$activities->isEmpty())
        <ul id="activities">
        @foreach($activities as $activity)
            <?php $joinable = true ?>
            <li class="activity">
                <h2>{{ $activity->titulo }}</h2>
                <h3>Lugar</h3>
                <p><b>{{ $activity->provincia }}</b> {{ $activity->poblacion }} {{ $activity->direccion }}</p>
                <h3>Horario</h3>
                <p><b>{{ $activity->fecha_inicio }}</b> {{ $activity->fecha_fin }}</p>
                <p><b>{{ $activity->hora_inicio }}</b> {{ $activity->hora_fin }}</p>
                <h3>Descripción</h3>
                <p>{{ $activity->descripcion }}</p>
            </li>
            @if(Auth::check())
            <?php /* compruebo todos los usuarios unidos a esta actividad, para permitirles o no unirse */ ?>
                @foreach($activity->users as $user)
                    @if ($user->id == Auth::user()->id)
                        <?php $joinable = false ?>
                    @endif
                @endforeach
                @if ($activity->id_creator != Auth::user()->id && $joinable == true)
                    <button class="joinButton" id="{{ $activity->id }}">Unirse</button>
                @elseif ($activity->id_creator != Auth::user()->id)
                    <button class="leaveButton" id="{{ $activity->id }}">Salir</button>
                @endif
            @endif
        @endforeach
        </ul>
    @else
        <h2>No hay actividades</h2>
    @endif

    @if(session('message'))
        {{--aqui quiero poner una x de icono y con css aparecera en medio y se podra cerrar--}}
        {{--saca el mensaje activdad creada--}}
        <div id="message">{{session('message')}}</div>
    @endif

    @include('includes.joinActivity')
    @include('includes.leaveActivity')

@endsection