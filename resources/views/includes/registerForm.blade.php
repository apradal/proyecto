<div id="registerForm">
    <img class="icon cancel" src="{{URL::to('/images/002-cross.png')}}" alt="">
    <div class="wrapper-table">
        <h1 class="title-md">Formulario de registro</h1>
        {!! Form::open(['url' => '/registerUser', 'id' => 'registerUserForm']) !!}
        {{Form::text('email', '', ['placeholder' => 'Email: Ejemplo@gmail.com'])}}
        {{Form::password('password', ['placeholder' => 'Contraseña secreta'])}}
        {{Form::text('name', '', ['placeholder' => 'Nombre: José Antonio'])}}
        {{Form::text('lastName', '', ['placeholder' => 'Apellidos: Prada Lara'])}}
        <label for="provinces">Provincia:</label>
        <select id="provinces"  name="provinces">
                <option disabled selected value> Provincias </option>
            @foreach ($provinces as $province)
                <option value="{{ $province }}">{{ $province }}</option>
            @endforeach
        </select>
        <input type="submit"  class="a-btn filled" value="Registrarse" id="Registrarse">
        {!! Form::close() !!}
        <div class="errors"></div>
        <div class="success"></div>
    </div>
</div>