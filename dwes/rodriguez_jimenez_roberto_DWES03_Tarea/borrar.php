<?php
if (empty($_POST)) {
    header("Location:listado.php");
}

$titulo = "Borrar producto";
include_once("vistas/head.php");
include_once("includes/conexion.php");
include_once("includes/utilidades.php");

$cnx = getConexion();

// Intentar ejecutar la consulta
$consulta = 'DELETE FROM productos WHERE id = ' . $_POST['id'];
$mensajeOk =  'Producto borrado correctamente.';
$mensajeKo =  'Ocurrió un error y no se pudo eliminar el producto.';
$mensaje = (ejecutarConsulta($consulta))? $mensajeOk : $mensajeOk;
require_once('vistas/mensaje.php');

$cnx = null; // Eliminar la conexión con la base de datos
include_once("vistas/footer.php");
?>