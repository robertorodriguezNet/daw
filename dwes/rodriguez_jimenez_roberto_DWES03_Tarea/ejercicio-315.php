<?php

// Comprobamos que exista el producto
if (isset($_POST["producto"])) {

    $host = 'localhost';
    $port = 3306;
    $user = 'gestor';
    $pass = 'secreto';
    $db = 'proyecto';

    $error = false;

    // Conectar con la base de datos
    @$cnxDb = mysqli_connect($host, $user, $pass, $db);

    // Si hay error se cierra la app
    if ($cnxDb->connect_error) {
        die('Error en la conexión: ' . $cnxDb->connect_error);
    }

    // Montamos las consultas
    $query = 'SELECT * FROM stocks WHERE producto = ' . $_POST['producto'];

    // Obtener un resultado
    $result = $cnxDb->query($query);

    // Pasamos el resultado a un objeto
    $stock = $result->fetch_object();

    $cnxDb->close();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.1.5</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-12 text-center" style="width: 100%">
                <h1>Ejercicio</h1>
            </div>
            <div class="col-12 text-center" style="width: 100%">
                <p>Crea una página web en la que se muestren las unidades existentes de un determinado producto en cada
                    una de las tiendas.</p>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col">
                <form method="post">
                    <fieldset class="p-3 rounded border border-gray">
                        <legend>Seleccionar un producto</legend>

                        <p class="mt-3 mb-3">
                            <label for="producto">Producto: </label>
                            <select name="producto" id="producto" class="rounded">
                                <option value="1">producto 1</option>
                                <option value="12">producto 12</option>
                                <option value="132">producto 132</option>
                            </select>
                        </p>

                        <button class="rounded">Mostrar</button>
                    </fieldset>
                </form>
            </div>
        </div>

        <?php if (isset($_POST['producto'])): ?>

            <div class="row mt-3 mb-3">
                <div class="col-6">
                    <table class="table border border-gray rounded">

                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Tienda</th>
                                <th class="text-center" scope="col">Uds.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($stock != null): ?>
                                <tr>
                                    <td class="text-center"><?= $stock->tienda ?></>
                                    <td class="text-center"><?= $stock->unidades ?></td>
                                </tr>
                                <?php $stock = $result->fetch_object(); ?>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                </div>
            </div>

        <?php endif ?>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>