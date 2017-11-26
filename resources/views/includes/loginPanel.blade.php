<nav id="userPanel">
    <a class="logo" href="{{ url('/')}}"><h3>Logo de vuelta</h3></a>
    <ul>
        @if (Auth::check())
            <li>
                <span>logueado {{Auth::user()->nombre}}</span>
            </li>
            <li>
                {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}

                {{Form::submit('Log Out')}}

                {!! Form::close() !!}
            </li>
            <li>
                <a href="{{ url('/createactivityform') }}">Crear actividad</a>
            </li>
            <li>
                <a href="{{url('/userpanel')}}">Mi cuenta</a>
            </li>
        @else
            <li>
                <button id="loginButton" class="btn-form">Login</button>
            </li>
            <li>
                <button id="registerButton" class="btn-form">Registrarse</button>
            </li>
        @endif
    </ul>

</nav>