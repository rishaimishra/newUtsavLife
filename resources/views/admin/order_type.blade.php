@extends('voyager::master')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title"> 
            <i class="icon voyager-double-right"></i> {{ $type }}
        </h1>
       
    </div>
@stop

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
       
    </div>
@stop

@section('javascript')

    

@stop
