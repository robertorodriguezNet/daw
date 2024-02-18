<?php 
/**
 * "instalacion.php": Carga la vista "vinstalacion.php" básicamente un botón para ir a "crearDatos.php" y crearnos datos de ejemplo.
 */

// autoload
require '../vendor/autoload.php';

// Librerías que vamos a usar
use Philo\Blade\Blade;

// Directorios de las vistas y la caché
$views = '../views';
$cache = '../cache';

// Datos que vamos a pasar a la vista
$titulo =  'DWES05 - Tarea';
$h1 = "Instalación";

// instancia de Blade
$blade = new Blade([$views],$cache);

// Cargar la vista
echo $blade->view()->make('vinstalacion',compact('titulo','h1'))->render();