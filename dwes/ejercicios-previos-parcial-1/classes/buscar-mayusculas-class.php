<?php

/**
 * Devuelve un array con los letras mayúsculas encontradas
 * en la cadena pasada como parámetro.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @param string $cadena cadena en la que buscar las mayúsculas
 * @return array con la colección de letras mayúsculas encontradas
 */
function buscarMayusculas($cadena): array
{
    /**
     * Convierte el texto de la cadena en un array.
     * El segundo parámetro indica cuántos caracteres entran en cada corte.
     * 
     * @var mixed 
     * @access private
     */
    $letras = str_split($cadena, 1); 

    /*
     * Recorremos la colección de letras obteniendo el índice para poder
     * referenciar el elemento.
     * Si ctype_upper($letra) devuelve false es porque no es una letra mayúscula
     * y, por lo tanto, la eliminanos de la colección con unset(índice del elemento),
     */
    foreach ($letras as $k => $letra) {
        if (!ctype_upper($letra)) {
            unset($letras[$k]);
        }
    }

    // Devolvemos el array con los índices nuevos
    return array_values($letras);
}