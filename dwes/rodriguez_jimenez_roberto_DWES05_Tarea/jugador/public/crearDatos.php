  <?php
// No hay vista para instalación

// Cargamos autoload
require '../vendor/autoload.php';

// Declaramos el uso de la clase Jugador dentro del namespace Clases
use Clases\Jugador;

// Crear una instancia de Faker para generar el código
$faker = Faker\Factory::create('es_ES');

// Instancia de Jugador
$j = new Jugador();

// Obtener las posiciones declaradas en el campo 'posicion' de la tabla 'jugadores'.
// Posiciones es un array con los valores del campo de tipo enum.
$posiciones = $j->getPosiciones();

for ($i = 0; $i < 25; $i++) {

    // Dorsal
    $dorsal = $i +1;

    // En cada iteración, $jugador es un nuevo jugador
    $jugador = new Jugador();
    $jugador->setNombre($faker->firstName());
    $jugador->setApellidos($faker->lastName() . ' ' . $faker->lastName);
    $jugador->setDorsal($dorsal);

    // Forzamos a que el dorsal 1 se para el portero
    $jugador->setPosicion(
        ($dorsal == 1)? $posiciones[0] : $faker->randomElement($posiciones)
    );
    $jugador->setBarcode($faker->unique->ean13);

    // Insertamos el nuevo jugador en la base de datos
    $jugador->create();

}

// Redirigimos a index.php 
header('location:index.php');