<?php
if (!isset($_GET['id'])) {
    header('Location:listado.php');
}

$titulo = "Modificar producto";
include_once("vistas/head.php");
include_once("includes/conexion.php");
include_once("includes/utilidades.php");

$cnx = getConexion($dsn, $user, $pass);

// -- Intentamos actualizar un producto ------------------------------------------------------
if (!empty($_POST) && isset($_GET['id'])) {

    $id = $_GET['id'];  // Guardar el id del producto para usarlo en la consulta

    // -- Verificar los datos -----------------------------------------------------------
    // Si no se valida, se sale de la aplicación.
    validarDatosCompletos(); 

    // Tenemos todos los campos

    // Validamos algunos campos y salimos  de la aplicación
    // si hay alguno que cumpla con el patrón
    $datos =validarFormato();
    $nombre = $datos['nombre'];
    $nombre_corto = $datos['nombre_corto'];
    $pvp = $datos['pvp'];
    $familia = $datos['familia'];
    $descripcion = $datos['descripcion'];

    // -- Fin de verificar los datos ----------------------------------------------------

    // Si se encontró algún error se habría salido de la aplicación, por lo que si
    // estamos aquí, es porque es correcto. Guardamos los datos.

    $consulta = @"UPDATE productos SET nombre = '$nombre', nombre_corto = '$nombre_corto', descripcion = '$descripcion', pvp = '$pvp', familia = '$familia' WHERE productos.id = $id";

    $mensajeOk = 'Producto actualizado correctamente.';
    $mensajeKo = 'Ocurrió un error y no se pudo actualizar el producto.';
    ejecutarConsulta($cnx, $consulta,  $mensajeOk, $mensajeKo);

}

// -- Fin de insertar un producto -------------------------------------------------------


// -- Formulario ------------------------------------------------------------------------
// El formulario se muestra solo si tenemos los datos
try {

    // Obtener los datos del producto a partir del id
    // La consulta nos devuelve un solo resultado
    $producto = @$cnx->query("SELECT * FROM productos WHERE id = " . $_GET['id']);

    // Al devolver un solo rgistro, no es necesario recorrer con while
    $caracteristicas = $producto->fetch(PDO::FETCH_OBJ);

    ?>
    <main class="container">
        <form method="post" class="row g-3">
            <div class="col-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?= @$caracteristicas->nombre ?>" class="form-control"
                    placeholder="Nombre" maxlength="200" required>
            </div>
            <div class="col-6">
                <label for="nombre_corto" class="form-label">Nombre corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" value="<?= @$caracteristicas->nombre_corto ?>"
                    class="form-control" placeholder="Nombre corto" maxlength="50" required>
            </div>
            <div class="col-6">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" name="precio" id="precio" value="<?= @$caracteristicas->pvp ?>" class="form-control"
                    min="0" value="0" step=".01" required>
            </div>
            <div class="col-6">
                <label for="familia" class="form-label">Familia</label>
                <select name="familia" id="familia" class="form-select" required>
                    <?php
                    try {
                        // Consulta a la base de datos
                        $listado = $cnx->query("SELECT * FROM familias ORDER BY nombre");

                        // Obtenemos los productos como objetos
                        $familia = $listado->fetch(PDO::FETCH_OBJ);
                        while ($familia != null):
                            ?>
                            <option value="<?= $familia->cod ?>" <?php if ($familia->cod == $caracteristicas->familia)
                                  echo 'selected'; ?>>
                                <?= $familia->nombre ?>
                            </option>
                            <?php
                            $familia = $listado->fetch(PDO::FETCH_OBJ);
                        endwhile;
                    } catch (PDOException $e) {
                        echo '<option value="">Error</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-8">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="5"
                    required><?= @$caracteristicas->descripcion ?></textarea>
            </div>
            <div class="col-12">
                <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="listado.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </main>

    <?php
} catch (PDOException $e) {    
    $mensaje = 'No se ha podido obtener los datos';
    require_once('vistas/excepcion.php');
} ?>


<?php
$cnx = null; // Eliminar el objeto con la conexión a la bd.
include_once("vistas/footer.php");
?>