@if(!$users->isEmpty())
    @foreach($users as $user)
        <li class="user<?php echo '-' . $user->id ?> user">
            {!! Form::open(['url' => '/deleteuser', 'class' => 'user-form', 'method' => 'get']) !!}
                <ul class="row">
                    <li class="col-sm-4">
                        <span style="font-weight: bold">Nombre:</span>
                        <span>{{ $user->nombre }}</span>
                     </li>
                    <li class="col-sm-4">
                        <span style="font-weight: bold">Apellidos:</span>
                        <span>{{ $user->apellidos }}</span>
                    </li>
                    <li class="col-sm-4">
                        <span style="font-weight: bold">Email:</span>
                        <span>{{ $user->email }}</span>
                    </li>
                </ul>
            <input type="hidden" name="id" value="{{ $user->id }}"/>
            <input type="submit" class="btn-form filled delete-user-btn" name="deleteuser" id="deleteuser" value="Eliminar"/>
            {!! Form::close() !!}
        </li>
    @endforeach
@else
    <h2 class="title" style="text-align: center">No existen actividades con estos filtros de búsqueda</h2>
@endif