<div id="loginForm">
    <h1>Formulario login</h1>
    {!! Form::open(['url' => '/submitLoginUser', 'id' => 'loginUserForm']) !!}
    {{Form::label('email', ' ')}}
    {{Form::text('email', '', ['placeholder' => 'Ejemplo@gmail.com'])}}
    {{Form::label('password', ' ')}}
    {{Form::password('password', ['placeholder' => 'Contraseña secreta'])}}
    {{Form::submit('Iniciar')}}
    {!! Form::close() !!}
    <div class="errors"></div>
    <div class="success"></div>
</div>
