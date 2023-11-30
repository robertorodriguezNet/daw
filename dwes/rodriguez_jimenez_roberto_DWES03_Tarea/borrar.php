<?php
if (empty($_POST)) {
    header("Location:listado.php");
}

$titulo = "Borrar producto";
include_once("includes/head.php");
include_once("includes/conexion.php");
include_once("includes/utilidades.php");

$cnx = getConexion($dsn, $user, $pass);

// Intentar ejecutar la consulta
$consulta = 'DELETE FROM productos WHERE id = ' . $_POST['id'];
$mensajeOk =  'Producto borrado correctamente.';
$mensajeKo =  'Ocurrió un error y no se pudo eliminar el producto.';
ejecutarConsulta($cnx, $consulta, $mensajeOk, $mensajeKo);

$cnx = null; // Eliminar la conexión con la base de datos
include_once("includes/footer.php");
?>