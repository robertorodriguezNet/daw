<?php
$titulo = "Gestión de productos";
include_once("vistas/head.php");
include_once("includes/conexion.php");
include_once("includes/utilidades.php");

$cnx = getConexion();
?>

<main class="container">

    <nav class="row my-2">
        <div class="col">
            <a href="crear.php" class="btn btn-success">Crear</a>
        </div>
    </nav>

    <section class="row my-2">
        <div class="col">

            <table class="table table-dark table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Detalle</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <class>
                    <tbody class="table-group-divider">
                        <?php
                        try {
                            // Consulta a la base de datos
                            $listado = $cnx->query("SELECT id, nombre FROM productos ORDER BY nombre");

                            // Obtenemos los productos como objetos
                            $producto = $listado->fetch(PDO::FETCH_OBJ);
                            while ($producto != null):
                                    ?>
                                    <tr>
                                        <?php set_error_handler("gestionarError"); ?>
                                        <td>
                                            <a href="detalle.php?id=<?= $producto->id ?>"
                                                class="btn btn-success bg-info">Detalle</a>
                                        </td>
                                        <td>
                                            <?= $producto->id ?>
                                        </td>
                                        <td>
                                            <?= $producto->nombre ?>
                                        </td>
                                        <td class="d-flex justify-content-around">
                                            <a href="update.php?id=<?= $producto->id ?>" class="btn btn-warning">Actualizar</a>
                                            <form action="borrar.php" method="post">
                                                <input type="hidden" name="id" id="id" value="<?= $producto->id ?>">
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </td>
                                        <?php restore_error_handler(); ?>
                                    </tr>
                                    <?php
                                $producto = $listado->fetch(PDO::FETCH_OBJ);
                            endwhile;
                        } catch (PDOException $e) {
                            $mensaje = 'Ocurrió algo inesperado y no se han podido recuperar los articulos';
                            require_once('vistas/mensaje.php');
                        }
                        ?>
                    </tbody>
                </class>
            </table>

        </div>
    </section>

</main>

<?php
$cnx = null; // Eliminar la conexión con la base de datos
include_once("vistas/footer.php");
?>