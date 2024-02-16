{{-- @ indica que son instrucciones Blade --}}

{{-- Esta página es una subpágina de plantilla1 --}}
@extends('plantillas.plantilla1')

{{-- Sección para el título --}}
@section('titulo')
    {{ $titulo }}
@endsection

{{-- Encabezado h1 --}}
@section('h1')
    {{ $h1 }}
@endsection

@section('contenido')

    <table class="container table table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Nombre Completo</th>
                <th scope="col">Posición</th>
                <th scope="col">Dorsal</th>
                <th scope="col">Código de barras</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jugadores as $jugador)
            <tr class="text-center">
                <td>{{$jugador->apellidos}}, {{$jugador->nombre}}</td>
                <td>{{$jugador->posicion}}</td>
                <td>{{$jugador->dorsal}}</td>
                <td>{{$jugador->barcode}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
