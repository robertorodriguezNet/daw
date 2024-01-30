<?php
require_once 'classes/arrays-class.php';

$array1 = ["lechuga", "puerro", "coliflor", "alcachofa"];
$array2 = ["pera", "manzana", "melón", "sandía", "naranja"];

$mezcla = mezclarArrays($array1, $array2);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mezclar-arrays.css">
</head>

<body>

    <header>
        <h1>Arrays</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Completa la función <strong>mezclarArrays</strong> que toma dos arrays y devuelve un nuevo array que
            contiene los elementos de ambos arrays intercalados.
        </p>
        <p class="pre">
            &lt;?php
            function <span class="name">mezclarArrays</span><span class="bracket">(</span><span
                class="variable">$array1</span><span class="symbol">,</span><span class="variable">$array2</span><span
                class="bracket">) {</span>
            <sapn class="comment">// Completa el código aquí</sapn>
            <span class="bracket">}</span>
            ?>
        </p>
    </section>

    <section id="ejercicio">

        <h3>Arrays</h3>
        <article id="arrays">
            <div>
                <ul>
                    <?php foreach ($array1 as $v): ?>
                        <li>
                            <?= $v ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <ul>
                    <?php foreach ($array2 as $v): ?>
                        <li>
                            <?= $v ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </article>

        <h3>Arrays mezcladas</h3>
        <ul>
            <?php foreach ($mezcla as $v): ?>
                <li>
                    <?= $v ?>
                </li>
            <?php endforeach; ?>
        </ul>


    </section>

    <section id="solucion">
        <h3>Solución</h3>
<pre>
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

</pre>

    </section>

</body>

</html>