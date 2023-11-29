<?php

// La conexión con la base de datos la tenemos que hacer aunque
// no haya peticiones, ya que tenemos que mostrar el listado de productos.
$host = 'localhost';
$port = 3306;
$user = 'gestor';
$pass = 'secreto';
$db = 'proyecto';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$cnxDb = new PDO($dsn,$user,$pass);

$cnxDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Si existen peticiones por POST
if(!empty($_POST) && isset($_POST['actualizar'])){

    // Se quiere actualizar un producto
    // Actualizamos antes de mostrar la tabla con los productos

    $unidades = $_POST['unidades'];
    $producto = $_POST['producto'];
    $tienda = $_POST['tienda'];

    $cnxDb->beginTransaction();
    $stmt = $cnxDb->prepare('UPDATE stocks SET unidades = :unidades WHERE producto = :producto AND tienda = :tienda');
    $isOk = ($stmt->execute([':unidades'=>$unidades,':producto'=>$producto, ':tienda'=>$tienda]));
    if($isOk){
        $cnxDb->commit();
    }
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
                                <?php
                                $listado = $cnxDb->query('SELECT id, nombre FROM productos ORDER BY nombre');
                                $producto = $listado->fetch(PDO::FETCH_OBJ);
                                while ($producto != null): ?>
                                    <option value="<?= $producto->id ?>" 
                                        <?php if(isset($_POST['producto']) && $_POST['producto'] == $producto->id):?>
                                            selected
                                            <?php endif; ?>
                                            >
                                        <?= $producto->nombre ?>
                                    </option>
                                    <?php
                                    $producto = $listado->fetch(PDO::FETCH_OBJ);
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
                            <?php 
                            $listado = $cnxDb->query('SELECT s.tienda, s.unidades, t.nombre FROM stocks as s, tiendas as t WHERE s.producto = ' . $_POST['producto'] . '  AND t.id = s.tienda');
                            $producto = $listado->fetch(PDO::FETCH_OBJ);
                            while ($producto != null): ?>
                                <tr>

                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                        <input type="hidden" name="tienda" id="tienda" value="<?= $producto->tienda ?>">
                                        <input type="hidden" name="producto" id="producto" value="<?= $_POST['producto']?>">
                                        <td>
                                            <?= $producto->nombre ?>
                                        </td>
                                        <td class="text-center">
                                            <input class="text-end" type="number" name="unidades" id="unidades" value="<?= $producto->unidades ?>" min="0" size="4" step="1">
                                        </td>
                                        <td>
                                            <input type="submit" id="actualizar" name="actualizar" value="Actualizar">
                                        </td>
                                    </form>

                                </tr>
                                <?php $producto = $listado->fetch(PDO::FETCH_OBJ); ?>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                </div>
            </div>

        <?php endif ?>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
<?php $cnxDb = null; ?>

</html>