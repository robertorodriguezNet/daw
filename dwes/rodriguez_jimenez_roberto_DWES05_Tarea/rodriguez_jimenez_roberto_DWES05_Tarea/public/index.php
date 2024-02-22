<?php 
session_start();
// Cargar los archivos que van a ser necesarios
require '../vendor/autoload.php';

// Declaramos el uso de la clase Jugador dentro del namespace Clases
use Clases\Jugador;

// Dependiendo de si hay contenido, se carga una página u otra
$load = (Jugador::isEmptyJugadores())? 'instalacion' : 'jugadores';
header("location:{$load}.php");