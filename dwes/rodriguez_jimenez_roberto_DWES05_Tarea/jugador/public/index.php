<?php 
require '../vendor/autoload.php';

use Clases\Jugador;

$j = new Jugador();
$load = ($j->isEmptyJugadores())? 'instalacion' : 'jugadores';
header("location:{$load}.php");