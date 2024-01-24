<?php
$title = 'Argumentos';
$page = 'dwes';
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/head.php';
require_once 'classes.php';
?>

<section class="enunciado">
    <h4>Enunciado</h4>
    <p>
        Con la ayuda de las funciones que necesites, haz un programa que, dados dos número enteros positivos, inicio y
        cantidad, nos muestre cantidad de números primos a partir de inicio, si no pasamos ningún valor cantidad=10.
    </p>
</section>

<form action="" method="post">
    <div>
        <label for="numero">Número</label>
        <input class="text-right" type="number" name="numero" id="numero" size="5" max="99" min="1" step="1">
    </div>
    <div>
        <label for="cantidad">Cantidad</label>
        <input class="text-right" type="number" name="cantidad" id="cantidad" size="5" max="99" min="1" step="1">
    </div>
    <div><input type="submit" name="calcular" id="calcular" value="Calcular"></div>
</form>

<section>
    <article>
        <?php
        if (isset($_POST['calcular'])) :?>
        <ul>
        <?php
            $primos = mostrarPrimos($_POST['numero'], $_POST['cantidad']);
            foreach($primos as $numero):?>
                <li><?=$numero?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </article>
</section>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/footer.php';
?>