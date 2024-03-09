<?php
/**
 * Script que muestra las funciones declaradas en el WSDL
 */

$cliente = new SoapClient("https://cvnet.cpd.ua.es/servicioweb/publicos/pub_gestdocente.asmx?wsdl");
$tipos = $cliente->__getTypes();
?>

<ul>
    <?php foreach($tipos as $k => $v): ?>
        <li>
            <code><?=$v?></code>
        </li>
    <?php endforeach ?>
</ul>