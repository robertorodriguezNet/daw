<?php
/** 
 * Esta página es el "action" del formulario para crear un jugador. 
 * Controlaremos errores para no introducir un dorsal que ya existe, 
 * que nombre y apellidos no esté vacios
 */

// Si no recibimos datos por POST, volvemos al formulario
if (!isset($_POST['nombre'])) {
    header('location:fcrear.php');
}

// Venimos del formulario
require '../vendor/autoload.php';

// Necesitamos la clase Jugador para comprobar los datos
use Clases\Jugador;

$jugador = new Jugador();

// Errores comprobados
$err = "";
if (empty($_POST['nombre'])) {
    $err .= 'nombre,';
}
;
if (empty($_POST['apellidos'])) {
    $err .= 'apellidos,';
}
if (!empty($_POST['dorsal']) && $jugador->existsDorsal($_POST['dorsal'])) {
    $err .= 'dorsal';
}

var_dump($_POST);

// No hay errores, guardamos el jugador
if (empty($err)) {
    $jugador->setNombre(trim($_POST['nombre']));
    $jugador->setApellidos(trim($_POST['apellidos']));
    $jugador->setDorsal(trim($_POST['dorsal']));
    $jugador->setApellidos(trim($_POST['apellidos']));
    $jugador->setPosicion(trim($_POST['posicion']));
    $jugador->setBarcode(trim($_POST['barcode']));

    try {
        $jugador->create();
    }catch(Exception $e){
        die("Error al guardar el jugador: " . $e->getMessage());
    }
}

// Redireccionamos al listado de jugadores
$url = 'jugadores.php?';
$url .= (empty($err)) ? 'create=ok' : 'err=' . $err;

header('location:' . $url);