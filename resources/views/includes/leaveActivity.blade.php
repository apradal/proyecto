<div id="leaveActivity">
    <img class="icon cancel" src="{{URL::to('/images/002-cross.png')}}" alt=""/>
    <div class="wrapper-table">
        <h1 class="title" id="leaveActivityTitle">Está apunto de salirse de la actividad </h1>
        <p>¿Está seguro?</p>
        {!! Form::open(['url' => '/leaveactivity', 'id' => 'leaveForm']) !!}
        {{ Form::hidden('activityId', '', array('id' => 'leaveActivityId')) }}
        <input type="submit" name="Salir" class="btn-form filled" value="Salir"/>
        {!! Form::close() !!}
        <button id="cancelLeaveActivity" class="a-btn filled">Cancelar</button>
    </div>
</div>