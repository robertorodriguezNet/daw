<?php
require '../vendor/autoload.php';

// Ruta al archivo wsdl
$url = 'http://' . $_SERVER['HTTP_HOST'] . substr(
    $_SERVER['PHP_SELF'],
    0,
    strripos(
        $_SERVER['PHP_SELF'],
        '/'
    )
) . '/servicio.wsdl';

try {

    // Crear el servidor.
    // Al pasarle el archivo WSDL no necesitamos más parámetros.
    $server = new SoapServer($url);

    // Clase que proporciona los métodos
    $server->setClass('Clases\Operaciones');

    $server->handle();
    
} catch (SoapFault $f) {
    die("Error en el servidor: " . $f->getMessage());
}
