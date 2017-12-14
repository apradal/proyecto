<div class="row filter-main">
    <div class="col-sm-12">
        <div id="filterBar">
            <div class="cover">
                <span class="filter-label">BUSQUEDA</span>
                {{--<label for="provincesSearch">Provincia</label>--}}
                <select id="provincesSearch"  name="provincesSearch" class="filter">
                    <option disabled selected value> Provincias </option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select>
                {{--<label for="typesSearch">Tipo</label>--}}
                <select id="typesSearch"  name="typesSearch" class="filter">
                    <option disabled selected value> Tipo </option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                <label for="dateSearch" class="filter-label">Fecha incio</label>
                <input type="date" id="dateSearch" class="filter"/>
                <input type="button" class="btn-form filter-btn" id="resetSearch" value="Reiniciar"/>
            </div>
        </div>
    </div>
</div>