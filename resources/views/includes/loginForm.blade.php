<div id="loginForm">
    <img class="icon cancel" src="{{URL::to('/images/002-cross.png')}}" alt="">
    <div class="wrapper-table">
        <h1 class="title-md">Login</h1>
        {!! Form::open(['url' => '/submitLoginUser', 'id' => 'loginUserForm']) !!}
        {{Form::text('email', '', ['placeholder' => 'Ejemplo@gmail.com'])}}
        {{Form::password('password', ['placeholder' => 'Contraseña secreta'])}}
        <input type="submit" name="Iniciar" value="Iniciar" class="a-btn filled"/>
        {!! Form::close() !!}
        <div class="errors"></div>
        <div class="success"></div>
    </div>
</div>
