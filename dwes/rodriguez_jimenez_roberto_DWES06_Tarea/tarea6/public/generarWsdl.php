<?php
/**
 * Con la extensión "php2wsdl" crea el archivo "public/generarWsdl.php" 
 * para generar el documento WSDL "servicio.wsdl" en "servidorSoap".
 * 
 * Los métodos que serán procesados deben estar documentados con @soap, @param y @return.
 */
require '../vendor/autoload.php';

use PHP2WSDL\PHPClass2WSDL;

// Clase que va a ser procesada
$class = "Clases\\Operaciones";

// Ruta al servidor
$uri = "http://127.0.0.1/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap/servicioW.php";

// Creamos la instancia del generador del archivo wsdl
$wsdlGenerator = new PHPClass2WSDL($class, $uri);

// Generar el documento wsdl especificando que solo deben convertirse los métodos marcados con @soap
$wsdlGenerator->generateWSDL(true);

// Guardar el fichero en su directorio
$file = $wsdlGenerator->save('../servidorSoap/servicio.wsdl');