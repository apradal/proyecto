<div id="filter-admin-bar">
    <div class="cover">
        <div id="menu-icon">
            <div></div>
            <div></div>
            <div></div>
        </div>
        {!! Form::open(['url' => '/admingetactivities', 'id' => 'adminForm', 'method' => 'get']) !!}
            <ul>
                <li>
                    <label for="id">Id</label>
                    <input type="number" id="id" name="id" class="solo">
                </li>
                <li>
                    <label for="id_creator">User Email</label>
                    <input type="email" id="id_creator" class="filter" name="id_creator"/>
                </li>
                <li>
                    <label for="tipo">Tipo</label>
                    <select id="tipo"  name="tipo" class="filter">
                        <option disabled selected value> Tipo </option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <label for="estado">Estado</label>
                    <select id="estado"  name="estado" class="filter">
                        <option value="">Todas</option>
                        <option value="activa">Activas</option>
                        <option value="finalizada">Finalizada</option>
                    </select>
                </li>
                <li>
                    <label for="fecha_inicio">Fecha incio</label>
                    <input type="date" id="fecha_inicio" class="filter" name="fecha_inicio"/>
                </li>
                <li>
                    <label for="fecha_fin">Fecha incio</label>
                    <input type="date" id="fecha_fin" class="filter" name="fecha_fin"/>
                </li>
                <li>
                    <input type="button" class="resetSearch btn-form filter-btn" value="Reiniciar"/>
                </li>
                <li>
                    <input type="submit" name="search" class="btn-form filled" id="searchButton" value="Buscar"/>
                </li>
            </ul>
        {!! Form::close() !!}
    </div>
</div>
<ul id="activities"><h1 style="text-align: center" class="title">Seleccione filtros de busqueda para mostrarle los resultados</h1></ul>