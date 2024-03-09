<?php
/**
 * Script que genera las clases a partir del documento.
 * 
 * Qué hacer:
 * - Se ejecuta este archivo antes que nada.
 * - Al ejecutarse el archivo se generan, en el directorio 'src',
 *   una serie de clases.
 * - Una vez creadas las clases, este script debe ser borrado.
 */

 require '../vendor/autoload.php';

 // Uso de las librerias por namespace
 use Wsdl2PhpGenerator\Generator;
 use Wsdl2PhpGenerator\Config;

 $generator = new Generator();
 $generator->generate(
    new Config([
        'inputFile' => "https://cvnet.cpd.ua.es/servicioweb/publicos/pub_gestdocente.asmx?wsdl", //wsdl
        'outputDir' => '../src',
        'namespaceName' => 'Clases'
    ])
 );