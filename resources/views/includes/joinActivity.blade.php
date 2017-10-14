<div id="joinActivity">
    <h3 id="joinActivityTitle">Está apunto de unirse a la actividad </h3>
    <p>¿Está seguro?</p>
    {!! Form::open(['url' => '/joinactivity', 'id' => 'joinForm']) !!}
    {{ Form::hidden('activityId', '', array('id' => 'activityId')) }}
    {{Form::submit('Unirse')}}
    {!! Form::close() !!}
    <button id="cancelJoinActivity">Cancelar</button>
</div>