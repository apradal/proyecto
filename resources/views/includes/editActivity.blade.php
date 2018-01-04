{!! Form::open(['url' => '/editactivity', 'id' => 'edit-form', 'method' => 'get']) !!}
<div class="container">
    <div class="alert alert-danger errordelete"></div>
    <div class="alert alert-success successdelete"></div>
    <div class="row fila">
        <div class="col-sm-4">
            <span>Id {{$activity->id}}</span>
            <input type="hidden" name="id" value="{{$activity->id}}">
        </div>
        <div class="col-sm-4">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{$activity->titulo}}"/>
        </div>
        <div class="col-sm-4">
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
        </div>
    </div>
    <div class="row fila">
        <div class="col-sm-4">
            <label for="poblacion">Población</label>
            <input type="text" name="poblacion" id="poblacion" value="{{$activity->poblacion}}"/>
        </div>
        <div class="col-sm-4">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="{{$activity->direccion}}"/>
        </div>
        <div class="col-sm-4">
            <span>Número participantes {{$activity->num_participantes}}</span>
        </div>
    </div>
    <div class="row fila">
        <div class="col-sm-4">
            <label for="max_participantes">Máximo participantes</label>
            <input type="number" name="max_participantes" id="max_participantes" value="{{$activity->max_participantes}}"/>
        </div>
        <div class="col-sm-4">
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
        </div>
        <div class="col-sm-4">
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
        </div>
    </div>
    <div class="row fila">
        <div class="col-sm-4">
            <label for="fecha_inicio">Fecha inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{$activity->fecha_inicio}}"/>
        </div>
        <div class="col-sm-4">
            <label for="fecha_fin">Fecha fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" value="{{$activity->fecha_fin}}"/>
        </div>
        <div class="col-sm-4">
            <label for="hora_inicio">Hora inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" value="{{$activity->hora_inicio}}"/>
        </div>
    </div>
    <div class="row fila">
        <div class="col-sm-4">
            <label for="hora_fin">Hora fin</label>
            <input type="time" name="hora_fin" id="hora_fin" value="{{$activity->hora_fin}}"/>
        </div>
        <div class="col-sm-4">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="5">{{$activity->descripcion}}</textarea>
        </div>
        <div class="col-sm-4">
            <label for="comment-admin">Comentario de edición o cierre</label>
            <textarea name="comment-admin" id="comment-admin" cols="30" rows="5"></textarea>
        </div>
    </div>
    <div class="row fila">
        <div class="col-sm-12">
            <div class="buttons-center">
                @if (Auth::user()->id == $activity->id_creator || Auth::user()->email == 'admin@proyecto.com')
                    <input type="submit" name="edit" value="Editar" class="filled btn-form"/>
                    <input type="submit" id="delete-activity-button" name="delete" value="Eliminar" class="filled btn-form"/>
                @endif
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
