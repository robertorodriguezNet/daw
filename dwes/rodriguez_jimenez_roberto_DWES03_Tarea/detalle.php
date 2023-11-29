<?php
$titulo = "Detalle producto";
include_once("includes/head.php");
include_once("includes/conexion.php");

// Intentar la conexión a la base de datos
try {
    $cnx = @new PDO($dsn, $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se ha podido conectar con la base de datos.\n" . $e->getMessage());
}
?>

<main class="container">
    <section class="row my-5">

        <?php
        if (!isset($_GET['id'])) {
            echo 'No se ha seleccionado ningún producto';
        } else {

            // Intentamos mostrar la información
            try {

                // La consulta nos devuelve un solo resultado
                $producto = $cnx->query("SELECT * FROM productos WHERE id = " . $_GET['id']);

                // Al devolver un solo rgistro, no es necesario recorrer con while
                $caracteristicas = $producto->fetch(PDO::FETCH_OBJ);
                ?>
                <div class="col-12 text-center bg-primary text-light rounded-top-3 m-0 p-3">
                    <h2><?= @$caracteristicas->nombre ?></h2>
                </div>
                <div class="col-12 bg-primary-subtle rounded-bottom-3 m-0 p-3">
                    <h3 class="text-center">
                        Código:
                        <?= @$caracteristicas->id ?>
                    </h3>
                <br>
                    <strong>Nombre:</strong>
                    <?= @$caracteristicas->nombre ?>
                <br>
                    <strong>Nombre corto:</strong>
                    <?= @$caracteristicas->nombre_corto ?>
                <br>
                    <strong>Familia:</strong>
                    <?= @$caracteristicas->familia ?>
                <br>
                    <strong>PVP (€):</strong>
                    <?= @$caracteristicas->pvp ?>
                <br>
                    <strong>Descripción:</strong>
                    <?= @$caracteristicas->descripcion ?>
                </div>

                <?php
            } catch (PDOException $e) {
                echo 'Nose ha podido acceder a los detalles: ' . $e->getMessage();
            }
        }
        ?>

        <div class="col-12 text-center my-3">
            <a href='listado.php' class='btn btn-primary'>Volver</a>
        </div>
    </section>
</main>

<?php
$cnx = null; // Eliminar la conexión con la base de datos
include_once("includes/footer.php");
?>