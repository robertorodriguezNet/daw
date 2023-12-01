<?php
$titulo = "Crear producto";
include_once("vistas/head.php");
include_once("includes/conexion.php");
include_once("includes/utilidades.php");

$cnx = getConexion();

// -- Intentamos crear un producto ------------------------------------------------------
if (!empty($_POST)) {

    // -- Verificar los datos -----------------------------------------------------------
    // Si no se valida, se sale de la aplicación.
    validarDatosCompletos();

    // Tenemos todos los campos

    // Validamos algunos campos y salimos  de la aplicación
    // si hay alguno que cumpla con el patrón
    $datos = validarFormato();
    $nombre = $datos['nombre'];
    $nombre_corto = $datos['nombre_corto'];
    $pvp = $datos['pvp'];
    $familia = $datos['familia'];
    $descripcion = $datos['descripcion'];
    // -- Fin de verificar los datos ----------------------------------------------------

    // Si se encontró algún error se habría salido de la aplicación, por lo que si
    // estamos aquí, es porque es correcto. Guardamos los datos.

    $consulta = "INSERT INTO productos (nombre, nombre_corto, descripcion, pvp, familia) VALUES ('$nombre', '$nombre_corto', '$descripcion', '$pvp', '$familia')";

    $mensajeOk = 'Producto guardado correctamente.';
    $mensajeKo = 'Ocurrió un error y no se pudo guardar el producto.';
    $mensaje = (ejecutarConsulta($cnx, $consulta))? $mensajeOk : $mensajeOk;
    require_once('vistas/mensaje.php');

}
// -- Fin de insertar un producto ----------------------------------------------------------
?>

<main class="container">
    <form method="post" class="row g-3">
        <div class="col-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" maxlength="200"
                required>
        </div>
        <div class="col-6">
            <label for="nombre_corto" class="form-label">Nombre corto</label>
            <input type="text" name="nombre_corto" id="nombre_corto" class="form-control" placeholder="Nombre corto"
                maxlength="50" required>
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
                        <option value="<?= $familia->cod ?>">
                            <?= $familia->nombre ?>
                        </option>
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
include_once("vistas/footer.php");
?>