<?php
/**
 * Esta página debe generar un código de barrar EAN-13 que sea válido y único.
 */
require '../vendor/autoload.php';

use Clases\Jugador;

$j = new Jugador();

$generador = Faker\Factory::create();

$exists = true;
do {
    $code = $generador->ean13();
    $exists = $j->existsBarcode($code);
} while ($exists);

echo $code;