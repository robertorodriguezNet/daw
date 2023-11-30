<?php
$titulo = "Modificar producto";
include_once("includes/head.php");
include_once("includes/conexion.php");

/**
 * Muestra un mensaje avisando de que ocurrió algún error.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.29
 * @param string $nombre nombre del producto.
 * @param string $nombre_corto nombre corto del producto.
 * @param string $precio del producto, con formato d*.dd
 * @param string $familia a la que pertenece el producto. Es texto.
 * @param string $descripcion del producto.
 * @param string $mensaje que se muestra.
 */
function mostrarElError($nombre, $nombre_corto, $precio, $familia, $descripcion, $mensaje)
{
    // Mostramos un mensaje de error si lo hubiera
    echo "<div class='container'>
        <div class='row justify-content-center'>
            <div class='col text-center'>
                <h1>Ocurrió algún error: $mensaje</h1>
                <h2>Revisa los datos</h2>
                <ul style='list-style: none' class='mx-0 px-0'>
                    <li>$nombre (máx. 200 caracteres)</li>
                    <li>$nombre_corto (máx. 50 caracteres)</li>
                    <li>$precio</li>
                    <li>$familia</li>
                    <li>$descripcion</li>
                </ul>
                <a href='crear.php' class='btn btn-primary'>Volver</a>
            </div>
        </div>
    </div>";
}

/**
 * FeedBack del resultado de la transacción.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.29
 * @param boolean $resultado de la transacción.
 */
function confirmarTransaccion($resultado)
{
    $mensaje = ($resultado) ? 'El producto se ha actualizado correctamente' :
        'No se ha podido actualizar el producto';

    echo "<div class='container'>
        <div class='row justify-content-center'>
            <div class='col text-center'>
                <h1>$mensaje</h1>
                <a href='listado.php' class='btn btn-primary'>Volver al listado</a>
            </div>
        </div>
    </div>";
}

// Intentar la conexión a la base de datos
try {
    $cnx = @new PDO($dsn, $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se ha podido conectar con la base de datos.\n" . $e->getMessage());
}


// -- Intentamos actualizar un producto ------------------------------------------------------
if (!empty($_POST) && isset($_GET['id'])) {

    $id = $_GET['id'];

    // -- Verificar los datos -----------------------------------------------------------
    $isOk = (isset($_POST['nombre']) && !empty($_POST['nombre'])) &&
        (isset($_POST['nombre_corto']) && !empty($_POST['nombre_corto'])) &&
        (isset($_POST['precio']) && !empty($_POST['precio'])) &&
        (isset($_POST['familia']) && !empty($_POST['familia'])) &&
        (isset($_POST['descripcion']) && !empty($_POST['descripcion']));

    // Mostramos el error si no se han recibido los datos correctamente.
    if (!$isOk) {
        mostrarElError(
            $_POST['nombre'],
            $_POST['nombre_corto'],
            $_POST['precio'],
            $_POST['familia'],
            $_POST['descripcion'],
            "Falta algún dato."
        );
    }

    // Tenemos todos los campos
    // El nombre corto lo convertimos en mayúsculas y eliminamos los espacios en blanco
    $nombre = stripslashes(trim($_POST['nombre']));
    $nombre_corto = stripslashes(
        trim(
            strtoupper(
                str_replace(" ", "", $_POST['nombre_corto'])
            )
        )
    );
    $precio = stripslashes(trim($_POST['precio']));
    $familia = stripslashes(trim($_POST['familia']));
    $descripcion = stripslashes(trim($_POST['descripcion']));

    // Comprobamos que el precio tenga el punto
    if (!preg_match('/\./', $precio)) {
        $precio .= ".00";
    }

    // Validamos algunos campos
    $isOk = preg_match("/^[A-ZÁÉÍÓÚa-záéíóú0-9 ]{1,200}$/", $nombre) &&
        preg_match("/^[A-Z0-9]{1,50}$/", $nombre_corto) &&
        preg_match('/^[0-9]*\.[0-9]{2}$/', $precio);

    if (!$isOk) {
        die(
            mostrarElError(
                $nombre,
                $nombre_corto,
                $precio,
                $familia,
                $descripcion,
                "Algún nombre no cumple con el patrón."
            )
        );
    }
    // -- Fin de verificar los datos ----------------------------------------------------

    // Hasta aquí, es correcto. Actualizamos los datos.
    if ($isOk) {

        try {

            // Tenemos la conexión, pues se obtiene al cargar el script.
            $consulta = "UPDATE productos SET nombre = '$nombre', nombre_corto = '$nombre_corto', descripcion = '$descripcion', pvp = '$precio', familia = '$familia' WHERE productos.id = $id";

            $cnx->beginTransaction();
            if ($cnx->exec($consulta)) {
                $cnx->commit();
                confirmarTransaccion(true);
            } else {
                $cnx->rollBack();
                confirmarTransaccion(false);
            }
        } catch (PDOException $e) {
            echo 'Error al guardar: ' . $e->getMessage();
        }
    }


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
                <input type="text" name="nombre" id="nombre" value="<?= @$caracteristicas->nombre ?>" class="form-control" placeholder="Nombre" maxlength="200"
                    required>
            </div>
            <div class="col-6">
                <label for="nombre_corto" class="form-label">Nombre corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" value="<?= @$caracteristicas->nombre_corto ?>"  class="form-control" placeholder="Nombre corto" maxlength="50" required>
            </div>
            <div class="col-6">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" name="precio" id="precio" value="<?= @$caracteristicas->pvp ?>" class="form-control" min="0" value="0" step=".01" required>
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
                            <option value="<?= $familia->cod ?>" <?php if($familia->cod == $caracteristicas->familia) echo 'selected';?>>
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
                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required><?= @$caracteristicas->descripcion ?></textarea>
            </div>
            <div class="col-12">
                <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="listado.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </main>

    <?php
} catch (PDOException $e) { ?>

    <main class="container">
        <div class="row">
            <div class="col-12 text-center my-3">
                No se ha podido obtener los datos.
            </div>
            <div class="col-12 text-center my-3">
                <a href='listado.php' class='btn btn-primary'>Volver</a>
            </div>
        </div>
    </main>

<?php } ?>


<?php
$cnx = null; // Eliminar el objeto con la conexión a la bd.
include_once("includes/footer.php");
?>