<?php
require_once('classes/calcular-promedio-class.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar mayúsculas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Calcular promedio</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
        Completa la función <strong>calcularPromedio</strong> para calcular el promedio de un array de números.
        </p>
        <pre>
&lt;?php
function calcularPromedio($numeros) {
// Completa el código aquí
}


$datos = [10, 20, 30, 40, 50];
$promedio = calcularPromedio($datos);

// Muestra el resultado
?>
        </pre>
    </section>


    <section id="ejercicio">
        <?php 
        $datos = ['10.43','20.3','30.6','40.345','50.1234'];
        $promedio = calcularPromedio($datos);
        printf("Promedio: %.2f", $promedio);
        ?>
    </section>

    <section id="solucion">
        <h3>Solución</h3>
<pre>
&lt;?php

/**
 * Devuelve el valor medio de los elementos del array
 * recibido como argumento.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @param mixed $numeros colección de números con los que hacer el cálculo
 * @return float el valor medio de los elementos de la colección
 */
function calcularPromedio(array $numeros): float
{
    /**
     * Acumula el valor de los elementos de la colección.
     * 
     * @var float
     */
    $total = 0.0;

    /*
     * Recorrer la colección de números y acumular el valor 
     * en $total
     */
    foreach($numeros as $v){
        $total += $v;
    }

    /**
     * Valor promedio de los elementos de la colección.
     * Se obtiene dividiendo el total entre el número de elementos de la
     * 
     * @var float
     */
    $promedio = $total / count($numeros);

    return $promedio;

}
        </pre>

<h4>Formateo del valor promedio (en el html):</h4>

<pre>
&lt;?php 
    $datos = ['10.43','20.3','30.6','40.345','50.1234'];
    $promedio = calcularPromedio($datos);
    printf("Promedio: %.2f", $promedio);
?>
</pre>

    </section>


    <script src="js/functions.js"></script>
</body>

</html>