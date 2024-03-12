<?php


 function autoload_8dd0a7dcc093b431415d97b82c2f8901($class)
{
    $classes = array(
        'Clases\ClasesOperacionesService' => __DIR__ .'/ClasesOperacionesService.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_8dd0a7dcc093b431415d97b82c2f8901');

// Do nothing. The rest is just leftovers from the code generation.
{
}
