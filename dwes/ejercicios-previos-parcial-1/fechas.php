<?php
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/fechas.js"></script>
</head>

<body>

    <header>
        <h1>Formato de fecha</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Escribe una función llamada <strong>cambiarFormatoFecha</strong> que tome una fecha en formato "YYYY-MM-DD"
            y la devuelva en formato "DD/MM/YYYY".
        </p>
        <p class="pre">
&lt;?php
function <span class="name">cambiarFormatoFecha</span><span class="bracket">(</span><span
    class="variable">$fecha</span><span class="bracket">) {</span>
<sapn class="comment">// Completa el código aquí</sapn>
<span class="bracket">}</span>
?>
        </p>
    </section>

    <section id="ejercicio">

        <fieldset>
            <legend>Selecciona una fecha</legend>
            <form name="form-date" id="form-date" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="date" name="inp-date" id="inp-date">
            </form>
        </fieldset>

        <?php if(isset($_POST['inp-date'])) : 
            // Crear un objeto DateTime a partir del texto proveniente del input
            $date = new DateTime($_POST['inp-date']);
        ?>
        <article>
            <p class="text-center">
                Fecha elegida: <?=$_POST['inp-date']?>
            </p>
            <p class="text-center">
                Fecha modificada: <?=date_format($date, 'd/m/Y')?>
            </p>
            <p class="text-center">
                strftime() está obsoleto para PHP 8.1 y posteriores.<br>
                strftime: <?=strftime("%A, %d de %B de %G",strtotime($_POST['inp-date']))?>
            </p>
        </article>
        <?php endif; ?>

    </section>

    <section id="solucion">
        <h3>Solución</h3>
        <p>
            Todo el proceso se realiza en fechas.php ya que el formateo se realiza directamente con funciones PHP.
        </p>
        <pre>
&lt;?php if(isset($_POST['inp-date'])) : 
    // Crear un objeto DateTime a partir del texto proveniente del input
    $date = new DateTime($_POST['inp-date']);
?>
&lt;article>
    &lt;p class="text-center">
        Fecha elegida: &lt;?=$_POST['inp-date']?>
    &lt;/p>
    &lt;p class="text-center">
        Fecha modificada: &lt;?=date_format($date, 'd/m/Y')?>
    &lt;/p>
    &lt;p class="text-center">
        strftime() está obsoleto para PHP 8.1 y posteriores.&lt;br>
        strftime: &lt;?=strftime("%A, %d de %B de %G",strtotime($_POST['inp-date']))?>
    &lt;/p>
&lt;/article>
&lt;?php endif; ?>            
        </pre>
    </section>

</body>

</html>