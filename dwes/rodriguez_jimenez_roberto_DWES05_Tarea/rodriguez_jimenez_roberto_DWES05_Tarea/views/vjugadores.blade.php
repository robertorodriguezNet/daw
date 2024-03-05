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
    <section class="container">

        {{-- Mensajes al venir del formulario --}}
        {{-- Los mensajes vienen en un array porque es en la vista --
          -- donde se decide su modo de verse.                     --}}
        @if (sizeof($mensajes) > 0)
        <div class="bg-secondary-subtle p-3">
            @foreach ($mensajes as $mensaje)
                <p>{{$mensaje}}</p>
            @endforeach
        </div>            
        @endif

        {{-- Botón de enlace al formulario para crear nuevos jugadores --}}
        <a href="fcrear.php" class="btn btn-success my-2">
            <i class="fa-solid fa-plus"></i> Nuevo Jugador
        </a>

        {{-- Tabla con el listado de los jugadores --}}
        <table class="table table-dark table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Posición</th>
                    <th scope="col">Dorsal</th>
                    <th scope="col">Código de barras</th>
                </tr>
            </thead>
            <tbody>
                {{-- Recorrer la colección de jugadores y mostrarlos en la tabla --}}
                @foreach ($jugadores as $jugador)
                    <tr class="text-center">
                        <td>{{ $jugador->apellidos }}, {{ $jugador->nombre }}</td>
                        <td>{{ $jugador->posicion }}</td>
                        <td>{{ ($jugador->dorsal == 0)? 'Sin asignar' : $jugador->dorsal }}</td>
                        {{-- El código de barras se genera a partir del valor numérico del campo barcode --}}
                        <td>{!! $barcode->getBarcodeSVG($jugador->barcode, 'EAN13', 3, 33, 'white', false) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection