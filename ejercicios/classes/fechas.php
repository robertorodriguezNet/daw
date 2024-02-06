<?php
define('SEMANA', ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado']);

function getDiaDeLaSemana(string $fecha): string
{
    
    // Obtener un objeto fecha a partir de la fecha
    $d = new DateTime($fecha);

    return SEMANA[date_format($d,'N')];
}