<?php 
session_start();
// Cargar los archivos que van a ser necesarios
require '../vendor/autoload.php';

// Declaramos el uso de la clase Jugador dentro del namespace Clases
use Clases\Jugador;

// Creamos un jugador para poder acceder a su método isEmptyJugadores
// y así comprobar si hay contenido en la tabla.
$j = new Jugador();

// Dependiendo de si hay contenido, se carga una página u otra
$load = ($j->isEmptyJugadores())? 'instalacion' : 'jugadores';
header("location:{$load}.php");