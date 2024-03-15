<?php
require '../vendor/autoload.php';

// Ruta al documento WSDL
$url = 'http://localhost/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap/servicio.wsdl';

// Parámetros para las funciones
$paramPVP              = ['idProducto' => 14];
$paramStock            = ['idProducto' => 14, 'idTienda' => 1];
$paramFamilias         = [];
$paramProductosFamilia = ['codFamilia' => 'CAMARA'];

// Creamos el cliente, pasándole el archivo WSDL
try {
    $cliente = new SoapClient($url);
} catch (SoapFault $f) {
    die("Error en el cliente: " . $f->getMessage());
}

// Solocitar los datos al servicio
$pvp = $cliente->__soapCall('getPVP', $paramPVP);
$stock = $cliente->__soapCall('getStock', $paramStock);
$familias = $cliente->__soapCall('getFamilias', $paramFamilias);
$productosDeFamilia = $cliente->__soapCall('getProductoFamilia', $paramProductosFamilia);
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

    <ul>
        <?php foreach ($cliente->__getFunctions() as $funcion) : ?>
            <li><?=$funcion?></li>
        <?php endforeach ?>
    </ul>

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