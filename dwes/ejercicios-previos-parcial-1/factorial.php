<?php
require_once 'classes/factorial-class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular factorial</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Calculo de factorial</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Completa el código para implementar una función que devuelva el factorial de un número.
        </p>
        <p class="pre">
            &lt;?php
            <span class="comment">// Completa el código para la función factorial</span>
            function <span class="name">factorial</span>($n) <span class="bracket">{
                }
            </span>
            <sapn class="comment">// Llama a la función con un número y muestra el resultado</sapn>
            $numero <span class="symbol">=</span> <span class="number">5</span><span class="symbol">;</span>
            <span class="name">echo</span> <span class="string">"El factorial de</span><span class="variable">
                $numero</span> <span class="string">es: "</span> . <span class="name">factorial</span><span
                class="bracket">(</span><span class="variable">$numero</span><span class="bracket">)</span>;
            ?>
        </p>
    </section>

    <section id="ejercicio">

        <fieldset>
            <legend>Calcular el factorial de:</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="hidden" name="calcular">
                <label for="numero">número:</label>
                <input type="number" name="inp-numero" id="inp-numero" required min="1" max="99" size="4" step="1" placeholder="1">
                <input type="submit" value="Calcular">
            </form>
        </fieldset>

        <?php if (isset($_POST['calcular'])): ?>
            <article>
                <p class="text-center">
                    5! = <?= getFactorial($_POST['inp-numero']) ?>
                </p>
            </article>
        <?php endif; ?>

    </section>

    <section id="solucion">
        <h3>Solución</h3>
        <h4>factorial.php</h4>

<pre>
&lt;?php 

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
</pre>

    </section>

</body>

</html>