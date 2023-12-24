<?php

// Comprobar si se ha logueado
session_start();
if (!isset($_SESSION['nombre'])) {
    header('location:login.php');
}

// Obtener el listado de los productos
require_once 'conexion.php';

// Crear el statement
$consulta = "SELECT * FROM productos";
$stmt = $conProyecto->prepare($consulta);
try {
    $stmt->execute();
} catch (PDOException $e) {
    cerrarTodo($conProyecto, $stmt);
    die("Error al recuperar los productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 04 - Listado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- css Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="estilos.css">
</head>

<?php
// Opciones que ofrece la página

// Si existe vaciar, vaciamos la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
}

// Hemos seleccionado un producto.
// lo añadimos a la cesta
if( isset($_POST['comprar'])){
    // El id del formulario se corresponde con el id del producto
    $_SESSION['cesta'][$_POST['id']] = $_POST['id'];
}
?>

<body>

    <!-- Info de la cesta --------------------------- -->
    <div class="row d-flex justify-content-end">

        <div class="col-3 p-2 d-flex justify-content-end">
            <!-- Cesta -->
            <i class="fa fa-shopping-cart fa-2x me-2"></i>
            <?php
            if (isset($_SESSION['cesta'])) {
                $cantidad = count($_SESSION['cesta']);
                echo "<input type='text' disabled class='form-control me-2 bg-transparent text-white' value='$cantidad' >";
            } else {
                echo "<input type='text' disabled class='form-control me-2 bg-transparent text-white' value='0'  size='10px'>";
            }
            ?>
            <!-- Usuario -->
            <i class="fa fa-user fa-2x me-2"></i>
            <input type="text" class="form-control me-2 bg-transparent text-white input-sm" disabled
                value="<?= $_SESSION['nombre'] ?>">
            <a href="cerrar.php" class="btn btn-warning me-2">Salir</a>
        </div>

    </div>
    <!-- Fin de info de la cesta ------------------- -->


    <main class="container">

        <!-- Botones -------------------------- -->
        <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-inline" name="vaciar" method="POST">
            <a href="cesta.php" class="btn btn-success me-2">Ir a la cesta</a>
            <input type="submit" value="Vaciar Carro" name="vaciar" class="btn btn-danger">
        </form>
        <!-- Fin de botones ------------------- -->

        <!-- Listado de productos ------------- -->
        <table class="table table-striped table-dark mt-3">
            <thead>
                <tr class="text-center">
                    <th scope="col">Producto</th>
                    <th scope="col">Añadir</th>
                    <th scope="col">Añadido</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($filas = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <th scope="row" class="text-center">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $filas->id ?>">
                                <input type="submit" name="comprar" value="Añadir" class="btn btn-primary">
                            </form>
                        </th>
                        <td><?= $filas->nombre ?>, precio: <?= $filas->pvp ?> (€)</td>
                        <td class="text-center">
                            <?php
                            if (isset($_SESSION['cesta'][$filas->id])) {
                                echo "<i class='fas fa-check fa-2x'></i>";
                            } else {
                                echo "<i class='far fa-times-circle fa-2x'></i>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <!-- Fin del listado de productos --------- -->

    </main>

</body>

</html>