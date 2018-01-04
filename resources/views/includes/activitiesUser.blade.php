<div id="activities-user">
    <h1 class="title" style="text-align: center; margin-top: 1%">Registro de actividades</h1>
    <ul>
        <?php foreach ($activities as $activity) : ?>
        <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
        <li class="activity <?php echo $activity->tipo?>">
            @if ($activity->id_creator == Auth::id())
                {!! Form::open(['url' => '/activityuser', 'class' => 'activity-form-creator', 'method' => 'get']) !!}
            @else
                {!! Form::open(['url' => '/activityuser', 'class' => 'activity-form', 'method' => 'get']) !!}
            @endif
            <h2 class="title">{{ $activity->titulo }}</h2><span class="estado">{{$activity->estado}}</span>
            <div class="clear"></div>
            <div class="row">
                <div class="col-sm-12"><span>{{$activity->user_role}}</span></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span>{{ $activity->provincia }}</span> {{ $activity->poblacion }} {{ $activity->direccion }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <span>Fecha inicio:</span> {{ $datesFormated[0] }}
                </div>
                <div class="col-sm-6">
                    @if($activity->fecha_fin) <span>Fecha fin:</span>{{$datesFormated[1] }} @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <span>Hora incio:</span> {{ $activity->hora_inicio }}
                </div>
                <div class="col-sm-6">
                    @if($activity->hora_fin)<span>Hora fin:</span> {{ $activity->hora_fin }} @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <span>Numero de inscritos:</span> {{$activity->num_participantes}}
                </div>
                <div class="col-sm-6">
                    <span>Numero máximo de participantes:</span> {{$activity->max_participantes}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <span>Descripción:</span>
                </div>
                <div class="col-sm-6">
                    {{ $activity->descripcion }}
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $activity->id }}"/>
            {!! Form::close() !!}
            @if($activity->estado === 'activa')
                @if ($activity->user_role === 'participante')
                    <button class="leaveButton btn-form filled" id="{{ $activity->id }}">Salir</button>
                @endif
            @endif
        </li>
        <?php endforeach; ?>
    </ul>
</div>