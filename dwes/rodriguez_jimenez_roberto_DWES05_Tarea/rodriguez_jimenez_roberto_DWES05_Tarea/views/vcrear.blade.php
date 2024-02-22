@extends('plantillas.plantilla1')

@section('titulo')
    {{ $titulo }}
@endsection

@section('h1')
    {{ $h1 }}
@endsection

@section('contenido')

<section class="container">

    {{-- Inicio del formulario --}}
    <form action="{{$action}}" method="POST" class="row">

        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
        </div>
        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" id="apellidos"placeholder="Apellidos" required>
        </div>
        <div class="col-4 mb-3">
            <label for="dorsal" class="form-label">Dorsal</label>
            <input class="form-control" type="number" name="dorsal" id="dorsal" min="1" max="99" step="1" placeholder="Dorsal">
        </div>
        <div class="col-4 mb-3">
            <label for="posicion" class="form-label">Posición</label>
            <select name="posicion" id="posicion" class="form-control" required>
                {{--- Las posiciones vienen en un array obtenido en el controlador --}}
                @foreach ($posiciones as $item)
                    <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4 mb-3">
            <label for="barcode" class="form-label">Código de barras</label>
            <input class="form-control bg-light text-end" type="text" name="barcode" id="barcode" placeholder="Código de barras" value="{{$barcode}}" readonly>
        </div>
        <div class="col-12">
            <input type="submit" value="Crear" id="crear" class="btn btn-primary me-3">
            {{-- El botón limpiar es un enlace en lugar de un reset --
              -- porque el reset no borra el campo 'barcode'        --}}
            <a href="{{$_SERVER['PHP_SELF']}}" class="btn btn-success me-3">Limpiar</a>
            <a href="jugadores.php" class="btn btn-info me-3">Volver</a>
            <a href="generarCode.php" class="btn btn-secondary">
                <i class="fa-solid fa-barcode me-3"></i> Generar Barcode
            </a>
        </div>

    </form>
</section>


@endsection