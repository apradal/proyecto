@if(!$activities->isEmpty())
    @foreach($activities as $activity)
        <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
        <li class="activity<?php echo ' .' . $activity->estado ?>">
            {!! Form::open(['url' => '/activityadmin', 'class' => 'activity-form', 'method' => 'get']) !!}
            <h2>{{ $activity->titulo }}</h2><span class="estado">{{$activity->estado}}</span>
            <h3>Lugar</h3>
            <p><b>{{ $activity->provincia }}</b> {{ $activity->poblacion }} {{ $activity->direccion }}</p>
            <h3>Horario</h3>
            <p><b>Fecha inicio:</b> {{ $datesFormated[0] }} @if($activity->fecha_fin) <b>Fecha fin:</b>{{ $datesFormated[1] }} @endif</p>
            <p><b>Hora incio:</b> {{ $activity->hora_inicio }} @if($activity->hora_fin)<b>Hora fin:</b> {{ $activity->hora_fin }} @endif</p>
            <p><b>Numero de inscritos:</b> {{$activity->num_participantes}} <b>Numero máximo de participantes:</b> {{$activity->max_participantes}}</p>
            <h3>Descripción</h3>
            <p>{{ $activity->descripcion }}</p>
            <input type="hidden" name="id" value="{{ $activity->id }}"/>
            {!! Form::close() !!}
        </li>
    @endforeach
@else
    <h2>No existen actividades con estos filtros de búsqueda</h2>
@endif