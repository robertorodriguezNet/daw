<?php 
spl_autoload_register(function($class){
    require "../src/" . $class . ".php";
});

// Comprobar si tenemos jugadores
$j = new Jugador();
$location = ($j->isEmptyJugadores())? "instalacion" : "jugadores";

header("location:{$location}.php");
