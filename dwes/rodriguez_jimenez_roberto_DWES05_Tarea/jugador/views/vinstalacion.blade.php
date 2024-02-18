{{--
 Esta es la vista que se va a mostrar en la página instalacion.php.
 Se reciben algunos datos desde instalacion.php.
  
 El código común a todas las páginas hay que obtenerlo de plantillas/plantilla1.blade.php.
 --}}
@extends('plantillas.plantilla1')

@section('titulo')
    {{ $titulo }}
@endsection

@section('h1')
    {{$h1}}
@endsection

@section('contenido')
<section class="container text-center">
    <a href="crearDatos.php"  class="btn btn-success">
        <i class="fa-solid fa-database me-2"></i> Instalar Datos de Ejemplo
    </a>
</section>
@endsection