<div id="filter-admin-bar">
    <span>Filtro de busqueda: </span>
    {!! Form::open(['url' => '/admingetactivities', 'id' => 'adminForm', 'method' => 'get']) !!}
        <label for="id">Id Actividad</label>
        <input type="number" id="id" name="id" class="solo">
        <label for="id_creator">User Email</label>
        <input type="email" id="id_creator" class="filter" name="id_creator"/>
        <label for="tipo">Tipo</label>
        <select id="tipo"  name="tipo" class="filter">
            <option disabled selected value> Tipo </option>
            @foreach ($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>
        <label for="estado">Estado</label>
        <select id="estado"  name="estado" class="filter">
            <option value="">Todas</option>
            <option value="activa">Activas</option>
            <option value="finalizada">Finalizada</option>
        </select>
        <label for="fecha_inicio">Fecha incio</label>
        <input type="date" id="fecha_inicio" class="filter" name="fecha_inicio"/>
        <label for="fecha_fin">Fecha incio</label>
        <input type="date" id="fecha_fin" class="filter" name="fecha_fin"/>
        <label for="resetSearch">Reiniciar búsqueda</label>
        <input type="button" class="resetSearch" value="Reiniciar"/>
        <input type="submit" name="search" id="searchButton" value="Buscar"/>
    {!! Form::close() !!}
</div>
<ul id="activities">Seleccione filtros de busqueda para mostrarle los resultados</ul>