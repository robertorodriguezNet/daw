<?php
$title = 'Cadenas de texto';
$page = 'dwes';
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/head.php';
?>

<section>
    <h2>printf</h2>
    <article>
        <p class="code">
            $ciclo="DAW";
                <br>
                $modulo="DWES";
                <br>
                printf("%s es un módulo de %dº curso de %s", $modulo, 2, $ciclo);
        </p>

        <p>
            Muestra:
            <?php
            $ciclo = "DAW";
            $modulo = "DWES";
            printf("%s es un módulo de %dº curso de %s", $modulo, 2, $ciclo);
            ?>
        </p>

        <ul>
            <li>%s especifica que el parámetro es un string.</li>
            <li>%d especifica que el parámetro es un decimal.</li>
        </ul>

    </article>

    <article>
        <h3>PI con signo y con 2 decimales</h3>
        <p class="code">
            printf("El número PI vale %+.2f", 3.1416);
        </p>
        <p>
            <?php printf("Número PI con signo y 2 decimales: %+.2f", 3.1416) ?>
        </p>
        <p>El símbolo "+" indica que debe mostrar el signo, tanto positivo como negativo.</p>

    </article>

    <article>
        <h3>Mostrar texto en varias líneas</h3>
        <p class="code">
                $ciclo = "Desarrollo de Aplicaciones Web";<br>
                $a =
                <<&lt;MICADENA $ciclo&lt;br /><br>
                Desarrollo Web en Entorno Servidor<br>
                MICADENA;<br>
                print $a;
        </p>
        <p>Imprime el texto respetando los saltos de línea:</p>
        <p>
            <?php
            $ciclo = "Desarrollo de Aplicaciones Web";
            $a = <<<MICADENA
                $ciclo<br />
                Desarrollo Web en Entorno Servidor
                MICADENA;
            print $a;
            ?>
        </p>
        <p>Si no queremos procesar las variables, entrecomillamos el identificador: </p>
        <p class="code">
                $ciclo = "Desarrollo de Aplicaciones Web";<br>
                $a =
                <<&lt;'MICADENA' $ciclo&lt;br /><br>
                Desarrollo Web en Entorno Servidor<br>
                MICADENA;<br>
                print $a;
        </p>
        <p>
            <?php
            $ciclo = "Desarrollo de Aplicaciones Web";
            $a = <<<'MICADENA'
                $ciclo<br />
                Desarrollo Web en Entorno Servidor
                MICADENA;
            print $a;
            ?>
        </p>
    </article>
</section>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/footer.php';
?>