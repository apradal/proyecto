<div id="personaldata">
    <h1>Datos personales</h1>
        <p>En esta ventana le mostramos toda su información personal.
        Puede modificar cualquier campo si así lo desea, simplemente cambiando la información y clicando en el botón modificar.</p>
        <fieldset>
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
                    <span>Fecha de registro: {{$user->fecha_registro}}</span>
                </li>
                <li>
                    {{Form::submit('Modificar')}}
                </li>
            </ul>
            {!! Form::close() !!}
            <div class="success"></div>
            <div class="errors"></div>
        </fieldset>
</div>