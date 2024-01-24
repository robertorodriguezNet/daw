<?php

/**
 * Devuelve true si el número recibido por parámetro es primo.
 */
function isPrimo(int $numero): bool
{

    // Si el número recibido en menor o igual que 1, devolvemos false.
    if ($numero <= 1)
        return false;

    // Recorrer los valores hasta el número evaluado para ver 
    // si es divisible por alguno.
    // Debería evaluarse hasta la mitad del valor del número
    for ($i = 2; $i < $numero; $i++) {

        // Si el resto es 0, es que no es divisible
        if ($numero % $i == 0)
            return false;

        if ($i > $numero / 2)
            break;
    }
    return true;
}


function mostrarPrimos(int $numero, int $cantidad): array
{
    $primos = array();

    // Recorrer todos los números
    do {
        if (isPrimo($numero)) {
            $primos[] = $numero;
        }
        $numero++;
        $cantidad--;
    } while ($cantidad > 0);
    return $primos;
}