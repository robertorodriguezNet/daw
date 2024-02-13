<?php
session_start();
//Comprobamos si somos un usuario invitado o normal
if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
    die();
}
//si no hemos nmandado el codigo delproducto a actualizar volvemos a listado
if (!isset($_GET['id'])) {
    header('Location:listado.php');
    die();
}
//Guardamos el nombre del usuario y el id
$usuario = $_SESSION['nombre'];
$cod = $_GET['id'];
//
//funcion para mostrar errores
function error($texto)
{
    $_SESSION['mensaje'] = $texto;
    header("Location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}"); //debemos volver a mandar el id.
    die();
}

//Autoload de las clases
spl_autoload_register(function ($class) {
    require "../class/" . $class . ".php";
});

//Iniciamos la conexión
$producto = new Producto();
$familias = new  Familia();
$producto->setId($cod);
$datos = $producto->read(); //recuperamos los datos para rellenar el formulario
$stmt = $familias->recuperarFamilias(); //recuperamos las familias para mostrar en el select
$familias = null;

//algunas funciones para validar campos
function comprobar(&$n, &$nc) //pasasmos por referencia porque vamos a modificarlos
{
    global $producto;
    //comprobamos que no esten vacios
    if (strlen($n) == 0 || strlen($nc) == 0) {
        error("Error ni el Nombre ni el nombre corto pueden estar en blanco");
    }

    $nc = strtoupper($nc); //ponemos nombre corto en mayúsculas.
    $n = ucwords($n); //ponemos la primera letra de cada palabra en mayúsculas.
    // y comprobamos que nombre corto no exista.
    if ($producto->existeNombreCorto($nc)) { //comprobamos todos los registros menos el del producto en cuestión. 
        error("Error ya existe un nombre corto con ese valor.");
    }
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Crear</title>
</head>

<body style="background: #4dd0e1">
<div class="float float-right d-inline-flex mt-2">
    <i class="fas fa-user mr-3 fa-2x"></i>
    <input type="text" size='10px' value="<?php echo $usuario; ?>" class="form-control mr-2 bg-transparent text-white"
           disabled>
    <a href='cerrar.php' class='btn btn-danger mr-2'>Salir</a>

</div>
<br><br>
<h3 class="text-center mt-2 font-weight-bold">Modificar Producto</h3>
<?php
if (isset($_SESSION['mensaje'])) {
    echo "<h4 class='container text-danger'>";
    echo $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    echo "</h4>";
}
?>
<div class="container mt-3">
    <?php
    if (isset($_POST['enviar'])) {
        //recogemos los datos del formlario, trimamos las cadenas
        $nombre = trim($_POST['nombre']);
        $nomCorto = trim($_POST['nombrec']);
        $pvp = $_POST['pvp'];
        $des = trim($_POST['descripcion']);
        $familia = $_POST['familia'];
        comprobar($nombre, $nomCorto);
        // si hemos llegado aqui todo ha ido bién vamos a crear el registro
        $producto->setNombre($nombre);
        $producto->setNombre_corto($nomCorto);
        $producto->setPvp($pvp);
        $producto->setFamilia($familia);
        $producto->setDescripcion($des);
        $producto->update();
        $_SESSION['mensaje'] = 'Producto Modificado Correctamente';
        $producto = null;
        header('Location: listado.php');
    } else {
    ?>
    <form name="crear" method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$cod"; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="n">Nombre</label>
                <input type="text" class="form-control" id="n" value='<?php echo $datos[0]->nombre ?>' name="nombre"
                       required>
            </div>
            <div class="form-group col-md-6">
                <label for="nc">Nombre Corto</label>
                <input type="text" class="form-control" id="nc" value='<?php echo $datos[0]->nombre_corto ?>'
                       name="nombrec" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="p">Precio (€)</label>
                <input type="number" class="form-control" id="p" value='<?php echo $datos[0]->pvp ?>' name="pvp" min="0"
                       step="0.01" required>
            </div>
            <div class="form-group col-md-6">
                <label for="f">Familia</label>
                <select class="form-control" name="familia">
                    <?php
                    while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if ($datos[0]->familia == $filas->cod)
                            echo "<option value='{$filas->cod}' selected>$filas->nombre</option>";
                        else
                            echo "<option value='{$filas->cod}'>$filas->nombre</option>";
                    }
                    $stmt = null;
                    ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="d">Descripción</label>
                <textarea class="form-control" name="descripcion" id="d"
                          rows="12"><?php echo $datos[0]->descripcion ?></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-3" name="enviar">Modificar</button>
        <input type="reset" value="Limpiar" class="btn btn-success mr-3">
        <a href="listado.php" class="btn btn-info">Volver</a>
    </form>
</div>
<?php } ?>
</body>

</html>