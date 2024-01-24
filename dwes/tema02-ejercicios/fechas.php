<?php
$title = 'Fechas';
$page = 'dwes';
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/head.php';

date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es');
?>

<section>

    <article>
        <h2>Versión de PHP y funciones</h2>
        <p>
            La versión actual de PHP es la 8.2
        </p>
        <p>
            Establecer la zona horaria: <br>
            <span class="code">date_default_timezone_set('Europe/Madrid')</span>
        </p>
        <p>
            Establecer la localización para poder hacer uso de los nombres en local.<br>
            <span class="code">setlocale(LC_ALL,'es)'</span>
        <pre>date()</pre> no lee los <i>locales</i>.
        </p>
    </article>

    <article>
        <h3>DateTime</h3>
        Crear un objeto
        <pre>DateTime</pre> a partir de una fecha:
        <p class="code">
            $fecha = new DateTime("2020-01-01");
        </p>
        <p>
            Resultado: <br>
            <?php
            $fecha = new DateTime("2020-01-01");
            var_dump($fecha);
            ?>
        </p>
    </article>

</section>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/footer.php';
?>