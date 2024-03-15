<?php
require '../vendor/autoload.php';

// Declaramos el uso de la clase del namespace Clase1
use Clases1\ClasesOperacionesService;

// Objeto de la clase que implementa las operaciones y que
// ha sido creado de forma automática por wsdl2generator
$servicio = new ClasesOperacionesService();

// Obtnemos los datos que se van a mostrar
$pvp = $servicio->getPVP(14);
$stock = $servicio->getStock(14,1);
$familias = $servicio->getFamilias();
$productosDeFamilia = $servicio->getProductoFamilia('CAMARA');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio SOAP</title>
</head>

<body>

    <h1>Servicio SOAP utilizando WSDL</h1>

    <h2>Funciones disponibles</h2>

    <p>El precio del producto 14 es de <?= $pvp ?> y hay <?= $stock ?> unidades en stock</p>

    <h2>Familias de productos</h2>
    <ul>
        <?php foreach ($familias as $familia) : ?>
            <li>
                <?= $familia["nombre"] ?> (<?= $familia["cod"] ?>)
            </li>
        <?php endforeach ?>
    </ul>

    <h2>Productos de una familia</h2>
    <ul>
        <?php foreach ($productosDeFamilia as $producto) : ?>
            <li>
                <?= $producto["nombre"] ?> <?= $producto["pvp"] ?> €
            </li>
        <?php endforeach ?>
    </ul>

</body>

</html>