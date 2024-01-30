<?php

function mezclarArrays(array $array1, array $array2): array{

    // Hay que comprobar qué array tiene mayor número de elementos
    if(count($array1) >= count($array2)){
        $principal = $array1;
        $secundaria = $array2;
    }else{
        $principal = $array2;
        $secundaria = $array1;        
    }

    $mezcla = [];

    foreach($principal as $k => $v){
        $mezcla[] = $v;
        if(array_key_exists($k,$secundaria)){
            $mezcla[] = $secundaria[$k];
        }
    }

    return $mezcla;
}
