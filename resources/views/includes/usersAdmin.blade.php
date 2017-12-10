@if(!$users->isEmpty())
    @foreach($users as $user)
        <li class="user<?php echo '-' . $user->id ?>">
            {!! Form::open(['url' => '/deleteuser', 'class' => 'user-form', 'method' => 'get']) !!}
            <h3>Nombre</h3>
            <p>{{ $user->nombre }}</p>
            <h3>Apellidos</h3>
            <p>{{ $user->apellidos }}</p>
            <h3>Email</h3>
            <p>{{ $user->email }}</p>
            <input type="hidden" name="id" value="{{ $user->id }}"/>
            <input type="submit" name="deleteuser" id="deleteuser" value="Eliminar"/>
            {!! Form::close() !!}
        </li>
    @endforeach
@else
    <h2>No existen actividades con estos filtros de búsqueda</h2>
@endif