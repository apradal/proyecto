<div id="leaveActivity">
    <h3 id="leaveActivityTitle">Está apunto de salirse de la actividad </h3>
    <p>¿Está seguro?</p>
    {!! Form::open(['url' => '/leaveactivity', 'id' => 'leaveForm']) !!}
    {{ Form::hidden('activityId', '', array('id' => 'leaveActivityId')) }}
    {{Form::submit('Salir')}}
    {!! Form::close() !!}
    <button id="cancelLeaveActivity">Cancelar</button>
</div>