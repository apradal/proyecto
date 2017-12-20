<div id="joinActivity" class="font">
    <img class="icon cancel" src="{{URL::to('/images/002-cross.png')}}" alt=""/>
    <div class="wrapper-table">
        <h3 class="title" id="joinActivityTitle">Está apunto de unirse a la actividad </h3>
        <p>¿Está seguro?</p>
        {!! Form::open(['url' => '/joinactivity', 'id' => 'joinForm']) !!}
        {{ Form::hidden('activityId', '', array('id' => 'activityId')) }}
        <input type="submit" name="Unirse" value="Unirse" class="btn-form filled">
        {!! Form::close() !!}
        <button id="cancelJoinActivity" class="a-btn filled">Cancelar</button>
    </div>
</div>