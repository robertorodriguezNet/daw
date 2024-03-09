<?php

/**
 * Consumir el servicio de server.php
 */

$uri = "http://localhost" .
    substr(
        $_SERVER['PHP_SELF'],
        0,
        strrpos(
            $_SERVER['PHP_SELF'],
            '/'
        )
    );

$url = $uri . '/server.php';

$paramSaludo = [
    'texto' => "Manolo"
];
$param = [
    'a' => 51,
    'b' => 29
];

try{
    // El servicio no incluye un WSDL, por eso el primer
    // parámetro es null.
    // Si existiese un WSDL no harían falta más parámetros.
    $client = new SoapClient(
        null,
        [
            'location' => $url,
            'uri' => $uri,
            'trace' => true
        ]
    );
}catch(SoapFault $f){
    echo "Error: " . $f->getMessage();
}

$saludo = $client->__soapCall('saludo', $paramSaludo);
$suma   = $client->__soapCall('suma', $param);
$resta  = $client->__soapCall('resta', $param);

echo $saludo . "La suma es: $suma y la resta es: $resta";


// // Se podría hacer directamente
// $saludo = $client->saludo("nombre");
// $suma   = $suma(4,5);
// $resta   = $resta(4,5);