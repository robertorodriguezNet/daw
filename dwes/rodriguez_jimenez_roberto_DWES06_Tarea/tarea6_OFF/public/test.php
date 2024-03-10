<?php

use Clases\Conexion;
// use PDOException;

require '../vendor/autoload.php';

$consulta = "SELECT * FROM familias";
$conexion = Conexion::getConexion();
$stmt = $conexion->prepare($consulta);
$conexion = null;
try{
    $stmt->execute();
}catch(PDOException $e){
    die("Algo salió mal: " . $e->getMessage());
}

$result = $stmt->fetchAll(PDO::FETCH_OBJ);

var_dump($result);

