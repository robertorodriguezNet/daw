<?php 
spl_autoload_register(function($class){
    require "../" . $class . ".php";
});

use Clases\Jugador;

// Comprobar si tenemos jugadores
$j = new Jugador();
$location = ($j->isEmptyJugadores())? "instalacion" : "jugadores";

header("location:{$location}.php");