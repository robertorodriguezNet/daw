<?php 
// Cargar los archivos que van a se necesarios
require '../vendor/autoload.php';

// Declaramos el uso de la clase Jugador dentro del namespace Clases
use Clases\Jugador;

$j = new Jugador();
$load = ($j->isEmptyJugadores())? 'instalacion' : 'jugadores';
header("location:{$load}.php");