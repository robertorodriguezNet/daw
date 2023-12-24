<?php

// Comprobar si se ha logueado
session_start();
if (!isset($_SESSION['nombre'])) {
    header('location:login.php');
}

// Obtener el listado de los productos
require_once 'conexion.php';
// Almacenamos en un listado los productos de la cesta
if(isset($_SESSION['cesta'])){
    foreach($_SESSION['cesta'] as $id){
        $producto = consultarProducto($id);
        $listado[$id] = [$producto->nombre, $producto->pvp];
        $producto = null;
    }
}
cerrar($conProyecto);

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

    <h1 class="text-center my-3">Comprar productos</h1>
    <main class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6 card text-white bg-success bg-opacity-75">

                <div class="card-body">
                    <?php
                        if(!isset($_SESSION['cesta'])){
                            echo "<p class='card-text>Carrito vacío</p>";
                        }else{
                            $total = 0;
                            echo '<ul>';
                            foreach($listado as $v){
                                echo "<li>$v[0], PVP ($v[1]) €</li>";
                                $total += $v[1];
                            }
                            echo '</ul>';
                            echo '<hr>';
                            echo "<p class='card-text'><strong>Total:</strong><span class='ms-3'>$total €</span></p>";
                        }
                    ?>

                    <a href="listado.php" class="btn btn-primary me-2">Volver</a>
                    <a href="pagar.php" class="btn btn-danger">Pagar</a>
                </div>

            </div>
        </div>
    </main>
    
</body>
</html>