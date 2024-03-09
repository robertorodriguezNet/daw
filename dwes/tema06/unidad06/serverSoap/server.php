<?php
/**
 * Servicio web con las funciones resta, sume y saludo.
 */
require '../vendor/autoload.php';

$uri = substr( 
    $_SERVER['PHP_SELF'], 
    0, 
    strrpos(
        $_SERVER['PHP_SELF'], 
        '/'
    )
);

$parmetros = [
    'uri' => $uri
];

try{
    // Generar el servidor
    $server = new SoapServer(NULL, $parmetros);

    // Añadir las funciones al servicio
    $server->setClass('Operaciones');

    // Procesar las peticiones.
    // Recoge los datos recibidos por POST
    $server->handle();
}catch(SoapFault $f){
    die("Error en el servidor: " . $f->getMessage() );
}