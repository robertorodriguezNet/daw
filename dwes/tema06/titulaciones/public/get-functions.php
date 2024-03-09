<?php
/**
 * Script que muestra las funciones del archivo WSDL
 */

 // El parámetro array con la opción 'trace' es opcional.
 // 'trace' habilita la opción para averiguar qué pasa cuando la 
 // conexión web no funciona.
$cliente = new SoapClient(
    "https://cvnet.cpd.ua.es/servicioweb/publicos/pub_gestdocente.asmx?wsdl",
    array('trace' => true)
);
$funciones = $cliente->__getFunctions();
?>

<ul>
    <?php foreach($funciones as $k => $v) : ?>
        <li>
            <code><?=$v?></code>
        </li>
    <?php endforeach ?>
</ul>