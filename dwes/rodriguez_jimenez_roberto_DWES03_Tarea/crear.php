<?php
$titulo = "Crear producto";
include_once("includes/head.php");
include_once("includes/conexion.php");

// Intentar la conexión a la base de datos
try {
    $cnx = @new PDO($dsn, $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se ha podido conectar con la base de datos.\n" . $e->getMessage());
}


// -- Intentamos crear un producto -----------------
if(!empty($_POST)){

    $isNombreOk = (isset($_POST['nombre']) && !empty($_POST['nombre']));
    $isNombreCortoOk = (isset($_POST['nombre_corto']) && !empty($_POST['nombre_corto']));
    $isPrecioOk = (isset($_POST['precio']) && !empty($_POST['precio']));
    $isFamiliaOk = (isset($_POST['familia']) && !empty($_POST['familia']));
    $isDescripcionOk = (isset($_POST['descripcion']) && !empty($_POST['descripcion']));


    // El precio debe aparecer con un punto y dos decimales: 0.00

}



?>

<main class="container">
    <form method="post" class="row g-3">
        <div class="col-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
        </div>
        <div class="col-6">
            <label for="nombre_corto" class="form-label">Nombre corto</label>
            <input type="text" name="nombre_corto" id="nombre_corto" class="form-control" placeholder="Nombre corto" required>
        </div>
        <div class="col-6">
            <label for="precio" class="form-label">Precio (€)</label>
            <input type="number" name="precio" id="precio" class="form-control" min="0" value="0" step=".01" required>
        </div>
        <div class="col-6">
            <label for="familia" class="form-label">Familia</label>
            <select name="familia" id="familia" class="form-select" required>
                <option value="" selected></option>
                <?php
                        try {
                            // Consulta a la base de datos
                            $listado = $cnx->query("SELECT * FROM familias ORDER BY nombre");

                            // Obtenemos los productos como objetos
                            $familia = $listado->fetch(PDO::FETCH_OBJ);
                            while ($familia != null):
                                ?>
                                <option value="<?=$familia->cod?>"><?=$familia->nombre?></option>
                                <?php
                                $familia = $listado->fetch(PDO::FETCH_OBJ);
                            endwhile;
                        } catch (PDOException $e) {
                            echo 'Ocurrió algo inesperado y no se han podido recuperar las familias: \n' . $e->getMessage();
                        }
                        ?>
            </select>
        </div>
        <div class="col-8">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Crear</button>
            <button type="reset" class="btn btn-success">Limpiar</button>
            <a href="listado.php" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</main>
<?php 
$cnx = null; // Eliminar el objeto con la conexión a la bd.
include_once("includes/footer.php"); 
?>