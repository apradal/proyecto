<h1>Registro de actividades</h1>
<ul>
    <?php foreach ($activities as $activity) : ?>
    <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
    <li>
        <h2>{{ $activity->titulo }}</h2><span class="estado">{{$activity->estado}}</span>
        <p>{{$activity->user_role}}</p>
        <p><b>{{ $activity->provincia }}</b> {{ $activity->poblacion }} {{ $activity->direccion }}</p>
        <p><b>Fecha inicio:</b> {{ $datesFormated[0] }} @if($activity->fecha_fin) <b>Fecha fin:</b>{{$datesFormated[1] }} @endif</p>
        <p><b>Hora incio:</b> {{ $activity->hora_inicio }} @if($activity->hora_fin)<b>Hora fin:</b> {{ $activity->hora_fin }} @endif</p>
        <p><b>Numero de inscritos:</b> {{$activity->num_participantes}} <b>Numero máximo de participantes:</b> {{$activity->max_participantes}}</p>
        <p>{{ $activity->descripcion }}</p>
    </li>
    <?php endforeach; ?>
</ul>
