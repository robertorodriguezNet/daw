<?php
require_once('classes/buscar-mayusculas-class.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar mayúsculas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Buscar mayúsculas</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Completa la función buscarMayusculas para que devuelva un array con las letras mayúsculas presentes en una
            cadena.
        </p>
        <pre>
                    &lt;?php
                    function buscarMayusculas($cadena) {
                    // Completa el código aquí
                    }
                    $resultado = buscarMayusculas("Hola, Mundo");
                    // Muestra el resultado
                    ?>
                </pre>
    </section>


    <section id="ejercicio">

        <fieldset>
            <legend>Introduce un texto</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <label for="texto">Texto: </label>
                <input type="text" name="texto" id="texto" size="40" required placeholder="Aquí el texto">
                <input type="submit" name="comprobar" value="Comprobar">
            </form>
        </fieldset>

        <?php if (isset($_POST['comprobar'])): ?>
            <ul>
                <?php
                $resultado = buscarMayusculas($_POST['texto']);
                foreach ($resultado as $k => $v):
                    ?>
                    <li>(
                        <?= $k ?>)
                        <?= $v ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button id="btn-borrar">Borrar</button>
        <?php endif; ?>

    </section>

    <section id="solucion">
        <h3>Solución</h3>
        <pre>
function buscarMayusculas($cadena): array
{
    $letras = str_split($cadena, 1); // Convertir la cadena en array

    // Recorrer la cadena en busca de mayúsculas
    foreach ($letras as $k => $letra) {
        if (!ctype_upper($letra)) {
            unset($letras[$k]);
        }
    }

    // Devolvemos el array con los índices nuevos
    return array_values($letras);
}
</pre>
    </section>


    <script src="js/functions.js"></script>
</body>

</html>