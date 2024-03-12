<?php
require '../vendor/autoload.php';

// C:\xampp\htdocs\daw\dwes\rodriguez_jimenez_roberto_DWES06_Tarea\tarea6
$uri = 'http://' . $_SERVER['HTTP_HOST'] . substr(
                                                    $_SERVER['PHP_SELF'],
                                                    0,
                                                    strripos(
                                                        $_SERVER['PHP_SELF'],
                                                        '/'
                                                    )
                                                );
                                                
// al no indicar un archivo wsdl necesitamos pasar la ruta
// al servidor mediante el parámetro uri
$parametros = ['uri' => $uri];
try {
    $server = new SoapServer(NULL, $parametros);
    $server->setClass('Clases\Operaciones');
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
