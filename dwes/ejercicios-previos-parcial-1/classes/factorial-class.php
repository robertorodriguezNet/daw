<?php 

/**
 * Devuelve el factorial del número recibido como argumento.
 * 
 * @param int $number número que hay que procesar
 * @return int factorial del número recibido como argumento
 */
function getFactorial(int $number){

    $factorial = $number;
    $n = $number;

    // Para obteber el factorial de n debemos multiplicar n*n-1 hasta que n valga 2.
    // No se multiplica por 1 para evitar una ejecución.
    // n disminuye en 1 antes de realizarse la operación.
    do{
        $factorial *= --$n;
    }while( $n >= 2 );

    return $factorial;

}