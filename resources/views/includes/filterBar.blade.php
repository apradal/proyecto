<div class="row filter-main">
    <div class="col-sm-12">
        <div id="filterBar">
            <div class="cover">
                <div id="menu-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <ul>
                    <li><span class="filter-label">BUSQUEDA</span></li>
                    <li>
                        <select id="provincesSearch"  name="provincesSearch" class="filter">
                            <option disabled selected value> Provincias </option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}">{{ $province }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <select id="typesSearch"  name="typesSearch" class="filter">
                            <option disabled selected value> Tipo </option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <label for="dateSearch" class="filter-label">Fecha incio</label>
                        <input type="date" id="dateSearch" class="filter"/>
                    </li>
                    <li>
                        <input type="button" class="btn-form filter-btn" id="resetSearch" value="Reiniciar"/>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>