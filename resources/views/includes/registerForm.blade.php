<div id="registerForm">

    <h1>Formulario de registro</h1>

    {!! Form::open(['url' => '/registerUser', 'id' => 'registerUserForm']) !!}

    {{Form::label('email', 'Email: ')}}
    {{Form::text('email', '', ['placeholder' => 'Ejemplo@gmail.com'])}}<br/>

    {{Form::label('password', 'Contraseña: ')}}
    {{Form::password('password', ['placeholder' => 'Contraseña secreta'])}}<br/>

    {{Form::label('name', 'Nombre: ')}}
    {{Form::text('name', '', ['placeholder' => 'José Antonio'])}}<br/>

    {{Form::label('lastName', 'Apellidos: ')}}
    {{Form::text('lastName', '', ['placeholder' => 'Prada Lara'])}}<br/>

    {{Form::label('provinces', 'Provincia: ')}}
    <select id="provinces"  name="provinces">
            <option disabled selected value> Provincias </option>
        @foreach ($provinces as $province)
            <option value="{{ $province }}">{{ $province }}</option>
        @endforeach
    </select><br/>

    {{Form::submit('Registrarse')}}

    {!! Form::close() !!}

    <div class="errors"></div>
    <div class="success"></div>

</div>