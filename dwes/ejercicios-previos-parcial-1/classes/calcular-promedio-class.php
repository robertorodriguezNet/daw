<?php

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