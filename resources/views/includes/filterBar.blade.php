<div id="filterBar">
    <span>Filtro de busqueda: </span>
    <label for="provincesSearch">Provincia</label>
    <select id="provincesSearch"  name="provincesSearch" class="filter">
        <option disabled selected value> Provincias </option>
        @foreach ($provinces as $province)
            <option value="{{ $province }}">{{ $province }}</option>
        @endforeach
    </select>
    <label for="typesSearch">Tipo</label>
    <select id="typesSearch"  name="typesSearch" class="filter">
        <option disabled selected value> Tipo </option>
        @foreach ($types as $type)
            <option value="{{ $type }}">{{ $type }}</option>
        @endforeach
    </select>
    <label for="dateSearch">Fecha incio</label>
    <input type="date" id="dateSearch" class="filter"/>
    <label for="resetSearch">Reiniciar búsqueda</label>
    <input type="button" id="resetSearch" value="Reiniciar"/>
</div>