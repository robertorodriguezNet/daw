<?php
/**
 * Script para consultar las titulaciones de 2020
 */
require '../vendor/autoload.php';

use Clases\Pub_gestdocente;
use Clases\wstitulosuni;

$service = new Pub_gestdocente();
$request = new wstitulosuni('es','2020');
$titulos = $service->wstitulosuni($request);

var_dump($titulos);