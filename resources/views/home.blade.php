@extends('layouts.app')
@section('content')
    @include('includes.registerForm')
    <div class="container-fluid">
        @include('includes.filterBar')
    </div>
    <div class="container">
        @if(session('message'))
            <div id="message" class="alert alert-success">{{session('message')}}</div>
        @endif
        <ul id="activities">
            @include('includes.activities')
        </ul>
        @include('includes.joinActivity')
        @include('includes.leaveActivity')
    </div>
@endsection