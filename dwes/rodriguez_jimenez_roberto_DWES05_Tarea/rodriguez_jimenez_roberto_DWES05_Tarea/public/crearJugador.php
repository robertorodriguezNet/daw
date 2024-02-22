<?php
/** 
 * Esta página es el "action" del formulario para crear un jugador. 
 * Controlaremos errores para no introducir un dorsal que ya existe, 
 * que nombre y apellidos no esté vacios.
 * 
 * Este scrip no genera vistas.
 */

session_start();

// Reseteamos los errores y el ok del jugador creado, si lo hibiera.
// Estas variables de sesión también son eliminadas cuando son procesadas en su lugar correspondiente.
unset($_SESSION['error']);
unset($_SESSION['create']);

// Evitar cargar el script si no recibimos datos por POST.
// Volvemos al formulario
if (!isset($_POST['nombre'])) {
    header('location:fcrear.php');
}

// autoload para cargar los scripts necesarios
require '../vendor/autoload.php';

// Necesitamos la clase Jugador para comprobar los datos.
use Clases\Jugador;

$jugador = new Jugador();

// Errores comprobados
if (empty($_POST['nombre'])) {
    $_SESSION['error']['nombre'] = 'El nombre no puede estar vacío';
}
if (empty($_POST['apellidos'])) {
    $_SESSION['error']['apellidos'] = 'Los apellidos no pueden estar vacíos';
}
if (!empty($_POST['dorsal']) && Jugador::existsDorsal($_POST['dorsal'])) {
    $_SESSION['error']['dorsal'] = 'El dorsal ya existe';
}
if (empty($_POST['barcode']) || strlen($_POST['barcode']) < 13) {
    $_SESSION['error']['barcode'] = 'El código de barras no puede estar vacío o tiene un formato no válido';
}

// Si no existen errores se guarda el jugador y se carga el listado.
if (!isset($_SESSION['error'])) {
 
    try {
        $jugador->setNombre(trim($_POST['nombre']));
        $jugador->setApellidos(trim($_POST['apellidos']));
        $jugador->setDorsal(trim($_POST['dorsal']));
        $jugador->setApellidos(trim($_POST['apellidos']));
        $jugador->setPosicion(trim($_POST['posicion']));
        $jugador->setBarcode(trim($_POST['barcode']));

        $jugador->create();

        // Se crea la variable create=ok para indicar a jugadores.php que debe mostrar el mensaje de jugador creado
        $_SESSION['create'] = 'ok';


    } catch (Exception $e) {
        die("Error al guardar el jugador: " . $e->getMessage());
    }
}

// Redireccionamos al listado de jugadores
header('location: jugadores.php');
