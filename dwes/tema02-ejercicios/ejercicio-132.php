<?php
$title = 'Fechas';
$page = 'dwes';
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/head.php';

date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es.UTF-8');

define ("DIA_DE_LA_SEMANA", [
    'Monday' => 'lunes',
    'Tuesday' => 'martes',
    'Wednesday' => 'miércoles',
    'Thursday' => 'jueves',
    'Friday' => 'viernes',
    'Saturday' => 'sábado',
    'Sunday' => 'domingo',
]);

define ("MES", [
    "January" => "enero",
    "February" => "febrero",
    "March" => "marzo",
    "April" => "abril",
    "May" => "mayo",
    "June" => "junio",
    "july" => "julio",
    "August" => "agosto",
    "September" => "septiembre",
    "October" => "ocubre",
    "November" => "noviembre",
    "December" => "diciembre"
]);
?>

<h2 class="text-center">Funciones de fecha</h2>
<h3 class="text-center">Ejercicio 1.3.2</h3>

<section>
    <article>
        <div class="enunciado">
            <h4>Enunciado</h4>
            <p>
                Carlos se ha propuesto que en todas las páginas de un sitio Web, a efectos de impresión y demás,
                aparezca la fecha y la hora actual en castellano. Piensa que con ello mejorará mucho la presentación de
                las mismas.
            </p>
            <p>
                Crea el código necesario para que cada vez que abramos o actualicemos una página Web nos aparezca la
                fecha y la hora actual en castellano.</p>
        </div>

        <p>
            El temario obtiene la fecha a partir de un objeto <i>DateTime</i>, que está obsoleto a partir de PHP8.
        </p>
        <p class="code">
            date_default_timezone_set('Europe/Madrid');<br>
            setlocale(LC_ALL, 'es.UTF-8');<br><br>
            $ahora = new DateTime();<br>
            echo strftime('%A, %d de %B de %Y %H:%M:%S', date_timestamp_get($ahora));
        </p>
        <p>Resultado: <br>
            <?php
            $ahora = new DateTime();
            echo strftime('%A, %d de %B de %Y %H:%M:%S', date_timestamp_get($ahora));
            ?>
        </p>

        <p>
            Resuelto con <i>date</i>.
            Para traducir los nombres basta con crear un array asociativo para los nombres.
        </p>
        <p class="code">echo date('l, d \d\e F \d\e Y - h:i:s');</p>
        <p>Resultado: <br>
            <?=DIA_DE_LA_SEMANA[date('l')]?>, <?=date('d')?> de <?=MES[date('F')]?> de <?= date('Y - h:i:s')?>

        </p>

    </article>
</section>


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/footer.php';
?>