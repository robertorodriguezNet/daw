<?php
@include_once 'classes/fechas.php';

date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas: JS vs PHP</title>
    <link rel="stylesheet" href="css/fechas.css">
    <script src="js/fechas.js"></script>
</head>

<body>

    <h1 class="text-center">Fechas en JS y PHP</h1>

    <section id="enunciado">

        <article class="card">
            <h2>Enunciado</h2>
            <p>
                En este ejercicio el usuario te dará su fecha de nacimiento y debes escribir la función que calcula el
                dia de la semana en que nació. Se supone que el usuario introducirá los datos numéricos correctamente y
                en una fecha real.
            </p>
        </article>

        <article>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                <fieldset class="text-center">
                    <legend>Selecciona una fecha</legend>
                    <label for="inp-fecha">Fecha: </label>
                    <input type="date" name="inp-fecha" id="inp-fecha">
                    <input type="submit" name="btn-enviar" value="Enviar">
                </fieldset>
            </form>
        </article>

        <article>
            <?php
            if (isset($_POST['inp-fecha'])):
                ?>
                <p class="text-center" id="fecha-recibida">
                    <?= $_POST['inp-fecha'] ?>
                </p>
            <?php endif; ?>
        </article>

    </section>

    <section id="desarrollo">

        <article id="js" class="w-50">
            <h3 class="text-center">JavaScript</h3>
<pre id="js-code">
window.onload = () => {

    // Hay que comprobar si existe el componente fecha-recibida
    let fecha = document.getElementById('fecha-recibida');
    if(fecha != null){
        obtenerDia(fecha.innerHTML);
    }
}

const SEMANA = ['domingo','lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

/**
* Obtiene el día de la semana
* @param {String} fecha que se va a evaluar
*/
function obtenerDia(fecha){

    // Crear un objeto Date
    let date = new Date(fecha);

    // Componer el texto
    let p = document.createElement('p');
    let texto = document.createTextNode(`El día de la semana es ${SEMANA[date.getDay()]}`);
    p.setAttribute('style','text-align: center');
    p.appendChild(texto);

    let pre = document.getElementById('js-code');
    let nodo = document.getElementById('js');
    nodo.insertBefore(p,pre);

}    
</pre>
        </article>

        <article id="php" class="w-50">
            <h3 class="text-center">PHP</h3>

            <?php if (isset($_POST['inp-fecha'])): ?>
                <p class="text-center">El día de la semana es <?=getDiaDeLaSemana($_POST['inp-fecha'])?></p>
            <?php endif; ?>

<pre>
&lt;?php
define('SEMANA', ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado']);

function getDiaDeLaSemana(string $fecha): string
{
    
    // Obtener un objeto fecha a partir de la fecha
    $d = new DateTime($fecha);

    return SEMANA[date_format($d,'N')];
}
</pre>
        </article>

    </section>

</body>

</html>