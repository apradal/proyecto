@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check())
        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div id="createActivityForm">
                    <h1 class="title activity-title font">Crear actividad</h1>
                    {!! Form::open(['url' => '/createactivty', 'method' => 'GET']) !!}
                    {{Form::label('title', 'Título: ')}}
                    {{Form::text('title', '', ['placeholder' => 'Cine Palafox*', 'maxlength' => '30'])}}
                    {{Form::label('startDate', 'Fecha inicio actividad: (Obligatorio)')}}
                    {{Form::date('startDate',  \Carbon\Carbon::now())}}
                    {{Form::label('endDate', 'Fecha fin actividad: ')}}
                    {{Form::date('endDate')}}
                    {{Form::label('types', 'Tipo de actividad: ')}}
                    <select id="types"  name="types">
                        <option disabled selected value> Tipo </option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    {{Form::label('provinces', 'Provincia: ')}}
                    <select id="provinces"  name="provinces">
                        <option disabled selected value> Provincias </option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province }}">{{ $province }}</option>
                        @endforeach
                    </select>
                    {{Form::label('poblation', 'Población: ')}}
                    {{Form::text('poblation', '', ['placeholder' => 'La Muela*'])}}
                    {{Form::label('street', 'Dirección: ')}}
                    {{Form::text('street', '', ['placeholder' => 'Paseo Independencia 32*'])}}
                    {{Form::label('participants', 'Número de participantes: ')}}
                    {{Form::number('participants')}}
                    {{Form::label('startHour', 'Hora inicio: ')}}
                    {{Form::time('startHour')}}
                    {{Form::label('endHour', 'Hora fin: ')}}
                    {{Form::time('endHour')}}
                    {{Form::label('description', 'Breve descripción: ')}}
                    {{Form::textarea('description', null, ['size' => '30x5'])}}
                    {{Form::submit('Crear')}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @else
            <div id="row"><h1 class="title" style="text-align:center">Ops! No deberías estar aquí.</h1></div>
        @endif
    </div>
@endsection