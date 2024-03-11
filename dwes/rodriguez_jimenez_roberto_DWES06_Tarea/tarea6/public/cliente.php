<?php

$uri='http://localhost/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap';
$url = $uri . '/servicio.php';

$paramPVP              = ['idProducto' => 26];
$paramStock            = ['idProducto' => 26, 'idTienda' => 2];
$paramFamilias         = [];
$paramProductosFamilia = ['idFamilia' => 5];

try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri, 'trace'=>true]);
} catch (SoapFault $ex) {
    echo "Error: ".$ex->getMessage();
}

$pvp = $cliente->__soapCall('getPVP', $paramPVP);
$stock = $cliente->__soapCall('getStock', $paramStock);

echo "La precvio es $pvp y el stock $stock";
