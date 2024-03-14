<?php
require '../vendor/autoload.php';

use Clases\ClasesOperacionesService;

$servicio = new ClasesOperacionesService();

// // Parámetros para las funciones
// $paramPVP              = ['idProducto' => 14];
// $paramStock            = ['idProducto' => 14, 'idTienda' => 1];
// $paramFamilias         = [];
// $paramProductosFamilia = ['codFamilia' => 'CAMARA'];


$pvp = $servicio->getPVP(14);
$stock = $servicio->getStock(14,1);
$familias = $servicio->getFamilias();
$productosDeFamilia = $servicio->getProductoFamilia('CAMARA');
?>

<!DOCTYPE html>
<html lang="en">

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