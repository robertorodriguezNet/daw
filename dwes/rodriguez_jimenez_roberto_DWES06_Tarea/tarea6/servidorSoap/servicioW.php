<?php
require '../vendor/autoload.php';

// URL para mostrar el wsdl
// http://127.0.0.1/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap/servicioW.php?wsdl

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
