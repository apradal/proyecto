<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Activeko</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>

@include('includes.loginPanel')

<div id="createActivityForm">

    <h1>Crear actividad</h1>

    {!! Form::open(['url' => '/createactivty', 'method' => 'GET']) !!}

    {{Form::label('title', 'Título: ')}}
    {{Form::text('title', '', ['placeholder' => 'Cine Palafox*'])}}<br/>

    {{Form::label('startDate', 'Fecha inicio actividad: (Obligatorio)')}}
    {{Form::date('startDate',  \Carbon\Carbon::now())}}<br/>

    {{Form::label('endDate', 'Fecha fin actividad: ')}}
    {{Form::date('endDate')}}<br/>

    {{Form::label('types', 'Tipo de actividad: ')}}
    <select id="types"  name="types">
        <option disabled selected value> Tipo </option>
        @foreach ($types as $type)
            <option value="{{ $type }}">{{ $type }}</option>
        @endforeach
    </select><br/>

    {{Form::label('provinces', 'Provincia: ')}}
    <select id="provinces"  name="provinces">
        <option disabled selected value> Provincias </option>
        @foreach ($provinces as $province)
            <option value="{{ $province }}">{{ $province }}</option>
        @endforeach
    </select><br/>

    {{Form::label('poblation', 'Población: ')}}
    {{Form::text('poblation', '', ['placeholder' => 'La Muela*'])}}<br/>

    {{Form::label('street', 'Dirección: ')}}
    {{Form::text('street', '', ['placeholder' => 'Paseo Independencia 32*'])}}<br/>

    {{Form::label('startHour', 'Hora inicio: ')}}
    {{Form::time('startHour')}}<br/>

    {{Form::label('endHour', 'Hora fin: ')}}
    {{Form::time('endHour')}}<br/>

    {{Form::label('description', 'Breve descripción: ')}}
    {{Form::textarea('description', null, ['size' => '30x5'])}}<br/>

    {{Form::submit('Crear')}}

    {!! Form::close() !!}

    <div class="errors">
        {{--Shows ALL errors--}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        @endif
    </div>
    <div class="success"></div>

</div>

<script src="{{ asset('js/myJs.js') }}"></script>

</body>
</html>