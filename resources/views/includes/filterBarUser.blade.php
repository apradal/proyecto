<div>
    <div id="user-admin-bar">
        {!! Form::open(['url' => '/searchuser', 'id' => 'userdelete', 'method' => 'get']) !!}
        <label for="iduser">Id Usuario</label>
        <input type="number" id="iduser" name="iduser" class="solo">
        <label for="emailuser">User Email</label>
        <input type="email" id="emailuser" class="filter" name="emailuser"/>
        <label for="nombreuser">Nombre</label>
        <input type="text" id="nombreuser" name="nombreuser" class="filter"/>
        <label for="apellidosuser">Apellidos</label>
        <input type="text" id="apellidosuser" name="apellidosuser" class="filter"/>
        <input type="button" class="resetSearch btn-form filter-btn" value="Reiniciar"/>
        <input type="submit" name="search" class="btn-form filled" id="searchUser" value="Buscar"/>
        {!! Form::close() !!}
    </div>
</div>
<ul id="users"><h1 style="text-align: center" class="title">Seleccione filtros de busqueda para mostrarle los resultados</h1></ul>