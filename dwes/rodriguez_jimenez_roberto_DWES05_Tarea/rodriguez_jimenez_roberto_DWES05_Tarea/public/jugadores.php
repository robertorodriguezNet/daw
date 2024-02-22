<?php
/**
 * Este script es el encardo de obtener todos los datos que se pasarán a las vistas para que sean renderizados.
 * Llamamos al script que se va a encargar de cargar las que se vayan necesitando.
 * 
 * En las variables de sesión se pasan los errores generados en el formulario.
 * Si el formulario para crear un jugador no hay errores, también se crea una
 * variable de sesión 'create' con el valor 'ok' para saber que venimos del formulario.
 * 
 * Las variables de sesión creradas en el formulario son eliminadas una vez
 * que han sido procesadas.
 * 
 * La vista usada para mostrar el listado de jugadores es vjugadores.
 */
session_start();


require '../vendor/autoload.php';

// Especificamos el uso de la Blade dentro del namespace Philo/Blade
use Philo\Blade\Blade;
use Clases\Jugador;
use Milon\Barcode\DNS1D;

// Crear una instancia de barcode y especificar su ruta a la caché
$barcode = new DNS1D();
$barcode->setStorPath(__DIR__ . '/cache/');


// Directorios de las vistas y la caché en la que se irán guardando
// las vistas generadas
$views = '../views';
$cache = '../cache';


// Variables que le vamos a pasar a la plantilla
$titulo = 'DWES05 - Tarea';
$h1 = 'Listado de Jugadores';

// Obtener el listado de jugadores
$jugadores = Jugador::getListadoJugadores();

// Array para mostrar posibles mensajes
$mensajes = [];

// Comprobamos si se ha creado un jugador.
// En caso de haberse creado, se muestra un mensajey se aunla la variable de sesión
if (isset($_SESSION['create']) && ($_SESSION['create'] == 'ok')) {
    $mensajes[] = 'Jugador creado con éxito';
    unset($_SESSION['create']);
}

// Comprobamos los errores tras venir del formulario y los pasamos al array de mensajes
if(isset($_SESSION['error'])){
    foreach($_SESSION['error'] as $error){
        $mensajes[] = $error;
    }
    unset($_SESSION['error']);
}

// Crear la instancia de Blade.
// El tamario pasa la vista como primer argumento, pero el constructor
// exige un array con las vistas.
$blade = new Blade([$views], $cache);

// 'vjugadores' carga la vista view/vjugadores.blade.php
echo $blade->view()->make('vjugadores', compact('titulo', 'h1', 'jugadores', 'barcode', 'mensajes'))->render();