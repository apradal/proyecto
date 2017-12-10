<h2>Editar o eliminar actividad</h2>
<fieldset>
    {!! Form::open(['url' => '/editactivity', 'id' => 'edit-form', 'method' => 'get']) !!}
    <span>Id {{$activity->id}}</span>
    <input type="hidden" name="id" value="{{$activity->id}}">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" value="{{$activity->titulo}}"/>
    <label for="provincia">Provincia</label>
    <select name="provincia" id="provincia">
        @foreach($provinces as $province)
            @if ($province === $activity->provincia)
                <option value="{{$province}}" selected>{{$province}}</option>
            @else
                <option value="{{$province}}">{{$province}}</option>
            @endif
        @endforeach
    </select>
    <label for="poblacion">Población</label>
    <input type="text" name="poblacion" id="poblacion" value="{{$activity->poblacion}}"/>
    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" id="direccion" value="{{$activity->direccion}}"/>
    <span>Número participantes {{$activity->num_participantes}}</span>
    <label for="max_participantes">Máximo participantes</label>
    <input type="number" name="max_participantes" id="max_participantes" value="{{$activity->max_participantes}}"/>
    <label for="types">Tipo</label>
    <select name="tipo" id="tipo">
        @foreach($types as $type)
            @if ($type === $activity->tipo)
                <option value="{{$type}}" selected>{{$type}}</option>
            @else
                <option value="{{$type}}">{{$type}}</option>
            @endif
        @endforeach
    </select>
    <label for="estado">Estado</label>
    <select name="estado" id="estado">
        @foreach($states as $state)
            @if ($state === $activity->estado)
                <option value="{{$state}}" selected>{{$state}}</option>
            @else
                <option value="{{$state}}">{{$state}}</option>
            @endif
        @endforeach
    </select>
    <label for="fecha_inicio">Fecha inicio</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{$activity->fecha_inicio}}"/>
    <label for="fecha_fin">Fecha fin</label>
    <input type="date" name="fecha_fin" id="fecha_fin" value="{{$activity->fecha_fin}}"/>
    <label for="hora_inicio">Hora inicio</label>
    <input type="time" name="hora_inicio" id="hora_inicio" value="{{$activity->hora_inicio}}"/>
    <label for="hora_fin">Hora fin</label>
    <input type="time" name="hora_fin" id="hora_fin" value="{{$activity->hora_fin}}"/>
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" cols="30" rows="5">{{$activity->descripcion}}</textarea>
    <label for="comment-admin">Comentario de edición o cierre</label>
    <textarea name="comment-admin" id="comment-admin" cols="30" rows="5"></textarea>
    @if (Auth::user()->id === $activity->id_creator || Auth::user()->email === 'admin@proyecto.com')
        <input type="submit" name="edit" value="Editar"/>
        <input type="submit" id="delete-activity-button" name="delete" value="Eliminar"/>
    @endif
    {!! Form::close() !!}
</fieldset>
