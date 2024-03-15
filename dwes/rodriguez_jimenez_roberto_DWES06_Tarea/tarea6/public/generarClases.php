<?php
/**
 * Script que genera las clases a partir del documento WSDL.
 * 
 * Qué hacer:
 * - Se ejecuta este archivo antes que nada.
 * - Al ejecutarse el archivo se generan, en el directorio 'src', las clases especificadas en el WSDL.
 * - Una vez creadas las clases, este script debe ser borrado.
 */

require '../vendor/autoload.php';

 // Uso de las librerias por namespace
 use Wsdl2PhpGenerator\Generator;
 use Wsdl2PhpGenerator\Config;

 $generator = new Generator();

 $generator->generate(
    new Config([
        'inputFile'     => "http://127.0.0.1/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap/servicioW.php?wsdl",
        'outputDir'    => '../src/Clases1',
        'namespaceName' => 'Clases'
    ])
 );