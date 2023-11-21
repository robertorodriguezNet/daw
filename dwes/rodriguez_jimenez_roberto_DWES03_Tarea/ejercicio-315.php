<?php

// La conexión con la base de datos la tenemos que hacer aunque
// no haya peticiones, ya que tenemos que mostrar el listado de productos.
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

// Obtener el listado de productos
$consultaDeProductos = 'SELECT id, nombre FROM productos ORDER BY nombre';

$resultadoDeProductos = $cnxDb->query($consultaDeProductos);
$listadoDeProductos = $resultadoDeProductos->fetch_object();

// Comprobamos que exista el producto
if (isset($_POST["producto"])) {

    // Montamos las consultas
    $ConsultaDeUnProducto = 'SELECT s.unidades, t.nombre FROM stocks as s, tiendas as t WHERE s.producto = ' . $_POST['producto'] . '  AND t.id = s.tienda';
    //  'SELECT * FROM stocks WHERE producto = ' . $_POST['producto'];


    // Obtener un resultado
    $resultadoDeUnProducto = $cnxDb->query($ConsultaDeUnProducto);

    // Pasamos el resultado a un objeto
    $stockDeUnProducto = $resultadoDeUnProducto->fetch_object();
}

$cnxDb->close();
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

                                <?php while ($listadoDeProductos != null): ?>
                                    <option value="<?= $listadoDeProductos->id ?>" 
                                        <?php if(isset($_POST['producto']) && $_POST['producto'] == $listadoDeProductos->id):?>
                                            selected
                                            <?php endif; ?>
                                            >
                                        <?= $listadoDeProductos->nombre ?>
                                    </option>
                                    <?php
                                    $listadoDeProductos = $resultadoDeProductos->fetch_object();
                                endwhile;
                                ?>

                            </select>
                        </p>

                        <button class="rounded">Mostrar</button>
                    </fieldset>
                </form>
            </div>
        </div>

        <?php if (isset($_POST['producto'])): ?>

            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-6">
                    <table class="table border border-gray rounded">

                        <thead>
                            <tr>
                                <th class="text-center bg-light" scope="col">Tienda</th>
                                <th class="text-center bg-light" scope="col">Uds.</th>
                                <th class="text-center bg-light" scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($stockDeUnProducto != null): ?>
                                <tr>

                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                        <td>
                                            <?= $stockDeUnProducto->nombre ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $stockDeUnProducto->unidades ?>
                                        </td>
                                        <td>
                                            <input type="submit" id="actualizar" name="actualizar" value="Actualizar">
                                        </td>
                                    </form>

                                </tr>
                                <?php $stockDeUnProducto = $resultadoDeUnProducto->fetch_object(); ?>
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