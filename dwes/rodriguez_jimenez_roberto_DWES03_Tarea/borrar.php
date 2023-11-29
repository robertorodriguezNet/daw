<?php
if (empty($_POST)) {
    header("Location:listado.php");
}
$titulo = "Borrar producto";
include_once("includes/head.php");
include_once("includes/conexion.php");

// Intentar la conexión a la base de datos
try {
    $cnx = @new PDO($dsn, $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se ha podido conectar con la base de datos.\n" . $e->getMessage());
}

// Intentar ejecutar la consulta
try {

    $cnx->beginTransaction();
    ($cnx->exec('DELETE FROM productos WHERE id = ' . $_POST['id'])) ?
        $cnx->commit() : $cnx->rollBack();

} catch (PDOException $e) {
    echo 'Ocurrió un error y se puedo eliminar el producto: ' . $e->getMessage();
}

?>

<main class="container">
    <section class="row">
        <div class="col-12 text-center my-3">
            Producto con id
            <?= $_POST['id'] ?> borrado correctamente.
        </div>
        <div class="col-12 text-center my-3">
            <a href='listado.php' class='btn btn-primary'>Volver</a>
        </div>
    </section>
</main>

<?php
$cnx = null; // Eliminar la conexión con la base de datos
include_once("includes/footer.php");
?>