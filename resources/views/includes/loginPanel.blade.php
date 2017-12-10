<nav id="userPanel">
    <a class="logo" href="{{ url('/')}}"><img src="{{ URL::to('/images/logo-mini.png') }}" alt="logo"></a>
    <span class="title">Activeko</span>
    <div id="user-options">
        @if(Auth::check() && Auth::user()->nombre == 'Admin' && Auth::id() === 3)
        <span>Usuario: {{Auth::user()->nombre}}</span>
        <a href="{{ url('/admin') }}" class="header-a">Administrar</a>
        {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
            <input type="submit" class="btn-form filled" name="logout" value="Log Out">
        {!! Form::close() !!}
        @elseif (Auth::check())
            <span>Usuario: {{Auth::user()->nombre}}</span>
            <a href="{{ url('/createactivityform') }}" class="header-a">Crear actividad</a>
            <a href="{{url('/userpanel')}}" class="header-a">Mi cuenta</a>
            {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
            <input type="submit" class="btn-form filled" name="logout" value="Log Out">
            {!! Form::close() !!}
        @else
            <a id="loginButton" class="a-btn header-a">Login</a>
            <a id="registerButton" class="a-btn filled">Registrarse</a>
        @endif
    </div>
    <div class="clear"></div>
</nav>