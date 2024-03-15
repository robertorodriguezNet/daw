<?php

// Ruta del servidor SOAP
$uri = 'http://localhost/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap';

// Ruta del servicio
$url = $uri . '/servicio.php';

// Preparamos los parámetros para las solicitudes
$paramPVP              = ['idProducto' => 26];
$paramStock            = ['idProducto' => 26, 'idTienda' => 2];
$paramFamilias         = [];
$paramProductosFamilia = ['codFamilia' => 'CONSOL'];

// Generar el cliente de SOAP
try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri, 'trace' => true]);
} catch (SoapFault $ex) {
    echo "Error: " . $ex->getMessage();
}

// Solocitar los datos al servicio
$pvp = $cliente->__soapCall('getPVP', $paramPVP);
$stock = $cliente->__soapCall('getStock', $paramStock);
$familias = $cliente->__soapCall('getFamilias', $paramFamilias);
$productosDeFamilia = $cliente->__soapCall('getProductoFamilia', $paramProductosFamilia);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio SOAP</title>
</head>

<body>

    <h1>Servicio SOAP sin uso de WSDL</h1>

    <p>El precio del producto 26 es de <?= $pvp ?> y hay <?= $stock ?> unidades en stock</p>

    <h2>Familias de productos</h2>
    <ul>
        <?php foreach ($familias as $familia) : ?>
            <li>
                 <?=$familia["nombre"]?> (<?=$familia["cod"]?>)
            </li>
        <?php endforeach ?>
    </ul>

    <h2>Productos de una familia</h2>
    <ul>
        <?php foreach ($productosDeFamilia as $producto) : ?>
            <li>
                <?=$producto["nombre"]?> <?=$producto["pvp"]?> €
            </li>
        <?php endforeach ?>
    </ul>

</body>

</html>