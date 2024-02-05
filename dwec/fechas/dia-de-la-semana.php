<?php
$title = "Fechas en JS";
require_once 'header.php';

setlocale(LC_ALL, 'es');
date_default_timezone_set("Europe/Madrid");
?>

<section>

    <article class="card">
        <h2>Enunciado</h2>

        <p>
            En este ejercicio el usuario te dará su fecha de nacimiento y debes escribir la función que calcula el día
            de la semana en que nació. Se supone que el usuario introducirá los datos numéricos correctamente y en una
            fecha real.
        </p>
    </article>

    <article class="form">
        <label for="inp-fecha">Fecha: </label>
        <input type="date" name="inp-fecha" id="inp-fecha">
        <button id="btn-calcular">Calcular</button>
    </article>

</section>



<?php
require_once 'footer.php';
?>