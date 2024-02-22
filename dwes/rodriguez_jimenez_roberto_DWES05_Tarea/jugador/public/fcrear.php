<?php 
session_start();

/**
 * Es el formulario para crear el jugador. 
 * Llama a la vista: "vcrear.blade.php". 
 * A parte de los botones normales pondremos un botón para generar un código de barras válido ("href" a la página "generarCode.php"). 
 * El campo para el código de barra lo pondremos de sólo lectura (atributo "readonly")
 */

 // autoload
 require '../vendor/autoload.php';

 // Clases usadas y sus namespaces
 use Philo\Blade\Blade;
 use Clases\Jugador;

 // Directorios para blade
$views = '../views';
$cache = '../cache';

$titulo = 'DWES05 - Tarea';
$h1 = 'Crear Jugador';

// Obtenemos las posiciones de los jugadores
$jugador = new Jugador();
$posiciones = $jugador->getPosiciones();

// Destino del formulario
$action = 'crearJugador.php';

// En el formulario se va a solicitar el código de barras.
// La sesión se elimina una vez que obtenemos el código.
$barcode = (isset($_SESSION['barcode']))? $_SESSION['barcode'] : '';
unset($_SESSION['barcode']);

// Instancia de blade
$blade = new Blade([$views],$cache);

// Renderizar la vista
echo $blade->view()->make('vcrear',compact('titulo','h1','posiciones','action','barcode'))->render();