<?php 
/**
 * Es el formulario para crear el jugador. 
 * Llama a la vista: "vcrear.blade.php". 
 * A parte de los botones normales pondremos un botón para generar un código de barras válido ("href" a la página "generarCode.php"). 
 * El campo para el código de barra lo pondremos de sólo lectura (atributo "readonly")
 */
session_start();


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
$posiciones = Jugador::getPosiciones();

// Destino del formulario
$action = 'crearJugador.php';

/**
 * En el formulario se va a solicitar el código de barras.
 * En lugar de dejar vacío el campo, le pasamos una cadena vacía.
 * Hay que tener en cuenta que el campo barcode NO está vacío, sino que tiene una cadena de longitud 0.
 * ¿Por qué una cadena sin texto en lugar de un campo vacío?
 *      Al pasar un valor al campo, se evita que en la plantilla haya que tomar
 *      una decisión, pues el valor ya viene dado desde el 'controlador'.
 */
// La sesión se elimina una vez que obtenemos el código.
$barcode = (isset($_SESSION['barcode']))? $_SESSION['barcode'] : '';
unset($_SESSION['barcode']);

// Instancia de blade
$blade = new Blade([$views],$cache);

// Renderizar la vista
echo $blade->view()->make('vcrear',compact('titulo','h1','posiciones','action','barcode'))->render();