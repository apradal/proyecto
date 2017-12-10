<div class="container">
    @if(!$activities->isEmpty())
        @foreach($activities as $activity)
            <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
            <?php $userIn = false ?>
            <?php $notFull = true ?>
            <li class="activity<?php echo ' .' . $activity->estado ?>">
                <h2>{{ $activity->titulo }}</h2><span class="estado">{{$activity->estado}}</span>
                <h3>Lugar</h3>
                <p><b>{{ $activity->provincia }}</b> {{ $activity->poblacion }} {{ $activity->direccion }}</p>
                <h3>Horario</h3>
                <p><b>Fecha inicio:</b> {{ $datesFormated[0] }} @if($activity->fecha_fin) <b>Fecha fin:</b>{{ $datesFormated[1] }} @endif</p>
                <p><b>Hora incio:</b> {{ $activity->hora_inicio }} @if($activity->hora_fin)<b>Hora fin:</b> {{ $activity->hora_fin }} @endif</p>
                <p><b>Numero de inscritos:</b> {{$activity->num_participantes}} <b>Numero máximo de participantes:</b> {{$activity->max_participantes}}</p>
                <h3>Descripción</h3>
                <p>{{ $activity->descripcion }}</p>
            </li>
            @if(Auth::check())
                <?php /* compruebo todos los usuarios unidos a esta actividad, para permitirles o no unirse */ ?>
                @foreach($activity->users as $user)
                    @if ($user->id == Auth::user()->id)
                        <?php $userIn = true ?>
                    @endif
                    @if ($activity->num_participantes >= $activity->max_participantes)
                        <?php $notFull = false ?>
                    @endif
                @endforeach
                @if($activity->estado === 'activa')
                    @if($notFull == true)
                        @if ($activity->id_creator != Auth::user()->id && $userIn == false)
                            <button class="joinButton" id="{{ $activity->id }}">Unirse</button>
                        @endif
                        @if ($activity->id_creator != Auth::user()->id && $userIn == true)
                            <button class="leaveButton" id="{{ $activity->id }}">Salir</button>
                        @endif
                    @else
                        @if ($activity->id_creator != Auth::user()->id && $userIn == true)
                            <button class="leaveButton" id="{{ $activity->id }}">Salir</button>
                        @endif
                    @endif
                @endif
            @endif
        @endforeach
    @else
        <h2>No hay actividades</h2>
    @endif
</div>