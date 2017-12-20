<div id="personaldata">
    <h1 class="title" style="text-align: center; margin-top: 1%">Datos personales</h1>
    <div class="back-wrapper">
        <div class="success"></div>
        <div class="errors"></div>
        {!! Form::open(['url' => '/personaldata', 'id' => 'userInfo']) !!}
        <ul>
            <li>
                {{Form::label('nombre', 'Nombre: ')}}
                {{Form::text('nombre', $user->nombre)}}<br/>
            </li>
            <li>
                {{Form::label('apellidos', 'Apellidos: ')}}
                {{Form::text('apellidos', $user->apellidos)}}<br/>
            </li>
            <li>
                {{Form::label('email', 'Email: ')}}
                {{Form::text('email', $user->email)}}
                <span class="care">Campo para iniciar sesión.</span><br/>
            </li>
            <li>
                {{Form::label('password', 'Contraseña: ')}}
                {{Form::password('password', ['placeholder' => 'Contraseña secreta'])}}<br/>
            </li>
            <li>
                <?php $provinces = array_diff($provinces, array($user->provincia));?>
                <label for="provincia">Provincia: </label>
                <select id="provincia"  name="provincia">
                    <option selected value="{{$user->provincia}}"> {{$user->provincia}} </option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select><br/>
            </li>
            <li>
                <span><label for="fecha">Fecha de registro:</label> {{$user->fecha_registro}}</span>
            </li>
            <li>
                <input type="submit" name="Modificar" value="Modificar" class="btn-form filled">
            </li>
        </ul>
        {!! Form::close() !!}
    </div>
</div>