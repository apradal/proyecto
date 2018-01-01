<div>
    <div id="user-admin-bar">
        <div class="cover">
            <div id="menu-icon">
                <div></div>
                <div></div>
                <div></div>
            </div>
            {!! Form::open(['url' => '/searchuser', 'id' => 'userdelete', 'method' => 'get']) !!}
                <ul>
                    <li>
                        <label for="iduser">Id Usuario</label>
                        <input type="number" id="iduser" name="iduser" class="solo">
                    </li>
                    <li>
                        <label for="emailuser">User Email</label>
                        <input type="email" id="emailuser" class="filter" name="emailuser"/>
                    </li>
                    <li>
                        <label for="nombreuser">Nombre</label>
                        <input type="text" id="nombreuser" name="nombreuser" class="filter"/>
                    </li>
                    <li>
                        <label for="apellidosuser">Apellidos</label>
                        <input type="text" id="apellidosuser" name="apellidosuser" class="filter"/>
                    </li>
                    <li>
                        <input type="button" class="resetSearch btn-form filter-btn" value="Reiniciar"/>
                    </li>
                    <li>
                        <input type="submit" name="search" class="btn-form filled" id="searchUser" value="Buscar"/>
                    </li>
                </ul>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<ul id="users"><h1 style="text-align: center" class="title">Seleccione filtros de busqueda para mostrarle los resultados</h1></ul>