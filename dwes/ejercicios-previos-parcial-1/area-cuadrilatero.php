<?php
require_once('classes/rectangulo-class.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rectángulo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/rectangulo.css">
</head>

<body>

    <header>
        <h1>Calcular área de un rectángulo</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Completa la clase <strong>Rectangulo</strong> con un método para calcular el área.
        </p>
        <pre>
&lt;?php
class Rectangulo {
    public $base;
    public $altura;
    // Completa el código aquí
}

$rectangulo = new Rectangulo();
$rectangulo->base = 5;
$rectangulo->altura = 10;

// Calcula el área y muestra el resultado
?>
        </pre>
    </section>


    <section id="ejercicio">

        <fieldset>
            <legend>Valores para el cuadrilátero (max: 500 x 500)</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="calcular" id="calcular">
                <div>
                    <label for="base">Base: </label>
                    <input type="number" name="inp-base" id="inp-base" step="1" min="100" max="500" size="6" step="1"
                        placeholder="100" required>
                </div>
                <div>
                    <label for="altura">Altura: </label>
                    <input type="number" name="inp-altura" id="inp-altura" step="1" min="100" max="500" size="6" step="1"
                        placeholder="100" required>
                </div>
                <input type="submit" value="calcular" name="btn-calcular" id="btn-calcular">
            </form>
        </fieldset>

        <?php if (isset($_POST['calcular'])):

            // Crear el objeto rectangulo 
            $rectangulo = new Rectangulo();
            $rectangulo->base = $_POST['inp-base'];
            $rectangulo->altura = $_POST['inp-altura'];
            ?>
            <article id="solucion-caja">
                <div class="caja" style="width:<?= $rectangulo->base ?>px;height:<?= $rectangulo->altura ?>px;">
                    <p><?= $rectangulo->base ?> x <?= $rectangulo->altura ?></p>
                    <p>Área: <?= $rectangulo->getArea() ?></p>
                </div>
            </article>

        <?php endif; ?>

    </section>

    <section id="solucion">
        <h3>Solución</h3>
        <h4>html</h4>
<pre>
&lt;?php if (isset($_POST['calcular'])):

// Crear el objeto rectangulo 
$rectangulo = new Rectangulo();
$rectangulo->base = $_POST['inp-base'];
$rectangulo->altura = $_POST['inp-altura'];
?>

&lt;article id="solucion-caja">
    &lt;div class="caja" style="width:&lt;?= $rectangulo->base ?>px;height:&lt;?= $rectangulo->altura ?>px;">
        &lt;p>&lt;?= $rectangulo->base ?> x &lt;?= $rectangulo->altura ?>&lt;/p>
        &lt;p>Área: &lt;?= $rectangulo->getArea() ?>&lt;/p>
    &lt;/div>
&lt;/article>

&lt;?php endif; ?>
</pre>

        <h4>php</h4>
<pre>
&lt;?php 

class Rectangulo{

    public $base;

    public $altura;

    public function getArea():int{
        return $this->base * $this->altura;
    }

}


</pre>



    </section>


    <script src="js/rectangulo.js"></script>
</body>

</html>