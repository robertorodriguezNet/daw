{{-- @ indica que son instrucciones Blade --}}

{{-- Esta página es una subpágina de plantilla1--}}
@extends('plantillas.plantilla1')

{{-- Sección para el título --}}
@section('titulo')
    {{$titulo}}
@endsection

{{-- Encabezado h1 --}}
@section('h1')
    {{$h1}}
@endsection

@section('contenido')
@foreach ($jugadores as $jugador)
    <p>({{$jugador->dorsal}}) {{$jugador->nombre}} - {{$jugador->posicion}}</p>
@endforeach
@endsection