<div id="user-admin-bar">
    <span>Filtro de busqueda: </span>
    {!! Form::open(['url' => '/searchuser', 'id' => 'userdelete', 'method' => 'get']) !!}
    <label for="iduser">Id Usuario</label>
    <input type="number" id="iduser" name="iduser" class="solo">
    <label for="emailuser">User Email</label>
    <input type="email" id="emailuser" class="filter" name="emailuser"/>
    <label for="nombreuser">Nombre</label>
    <input type="text" id="nombreuser" name="nombreuser" class="filter"/>
    <label for="apellidosuser">Apellidos</label>
    <input type="text" id="apellidosuser" name="apellidosuser" class="filter"/>
    <label for="resetSearch">Reiniciar búsqueda</label>
    <input type="button" class="resetSearch" value="Reiniciar"/>
    <input type="submit" name="search" id="searchUser" value="Buscar"/>
    {!! Form::close() !!}
</div>
<ul id="users">Seleccione filtros de busqueda para mostrarle los resultados</ul>