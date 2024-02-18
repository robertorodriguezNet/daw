<?php 
// Este script es el encardo de obtener todos los datos que se pasarán a las vistas para que sean renderizados.
// Llamamos al script que se va a encargar de cargar las que se vayan necesitando.
require '../vendor/autoload.php';

// Especificamos el uso de la Blade dentro del namespace Philo/Blade
use Philo\Blade\Blade;
use Clases\Jugador;
use Milon\Barcode\DNS1D;

// Objeto instancia de barcode
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
$jugadores =(new Jugador())->getListadoJugadores();

// Si venimos del formulario, tendremos mensajes
$mensajes = [];
if(sizeof($_GET) > 0){

    // Jugador creado correctamente
    if(isset($_GET['create']) && ($_GET['create'] == 'ok')){
        $mensajes[] = 'Jugador creado con éxito';
    }

    // Jugador con errores
    if(isset($_GET['err'])){
        $errores = explode(',',$_GET['err']);
        foreach($errores as $error){
            switch($error){
                case 'nombre': $mensajes[] = 'El nombre no puede estar vacío';
                    break;
                case 'apellidos': $mensajes[] = 'Los apellidos no pueden estar vacíos';
                    break;
                case 'dorsal': $mensajes[] = 'El dorsal ya existe';
                    break;
                default: ;
            }
        }
    }
}

// Crear la instancia de Blade.
// El tamario pasa la vista como primer argumento, pero el constructor
// exige un array con las vistas.
$blade = new Blade([$views], $cache);

// 'vjugadores' carga la vista view/vjugadores.blade.php
echo $blade->view()->make('vjugadores',compact('titulo','h1','jugadores','barcode','mensajes'))->render();