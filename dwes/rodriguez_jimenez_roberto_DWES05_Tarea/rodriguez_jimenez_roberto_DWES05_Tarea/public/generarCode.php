<?php
/**
 * Esta página debe generar un código de barrar EAN-13 que sea válido y único.
 * El código generado se propaga a través de la variable de sesión 'barcode'.
 */
session_start();
require '../vendor/autoload.php';

// Cargamos la clase Jugador y Faker
use Clases\Jugador;
use Faker\Factory;

// La instancia de Faker no proporciona un generador de datos
$faker = new Factory();
$generador = $faker::create();

// Consideramos que código existe, y que debe seguir buscando mientra
// no encuentre uno que no exista.
$exists = true;
do {
    // Pedir un código a faker
    $code = $generador->ean13();
    // Comprobar si el código existe
    $exists = Jugador::existsBarcode($code);
} while ($exists);

// Se guarda en código devuelto en una variable de sesión para
// hacerla accesible desde cualquier lugar del sitio.
$_SESSION['barcode'] = $code;
header('location:fcrear.php');
// echo $code;