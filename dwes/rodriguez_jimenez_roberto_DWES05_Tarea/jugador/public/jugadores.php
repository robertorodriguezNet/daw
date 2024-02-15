<?php 
// Este script es el encardo de obtener todos los datos que se pasarán a las vistas para que sean renderizados.
// Llamamos al script que se va a encargar de cargar las que se vayan necesitando.
require '../vendor/autoload.php';

// Especificamos el uso de la Blade dentro del namespace Philo/Blade
use Philo\Blade\Blade;
use Clases\Jugador;

// Directorios de las vistas y la caché en la que se irán guardando
// las vistas generadas
$views = '../views';
$cache = '../cache';

// Variables que le vamos a pasar a la plantilla
$titulo = 'DWES05 - Tarea';
$h1 = 'Listado de Jugadores';

// Obtener el listado de jugadores
$jugadores =(new Jugador())->getListadoJugadores();

// Crear la instancia de Blade.
// El tamario pasa la vista como primer argumento, pero el constructor
// exige un array con las vistas.
$blade = new Blade([$views], $cache);

// 'vjugadores' carga la vista view/vjugadores.blade.php
echo $blade->view()->make('vjugadores',compact('titulo','h1','jugadores'))->render();