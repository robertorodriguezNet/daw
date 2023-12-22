<?php

/**
 * Contien el código para realizar la conexión a la base de datos.
 *
 * Al estar estar en desarrollo, los errores los establecemos en Exception 
 * para visualizarlos.
 */

$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// Crear la conexión PDP
try{
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die( "Error en la conexión: " . $e->getMessage() );
}

/**
 * Recupera la información del producto con el id pasado como argumento.
 * 
 * @param number $id referencia al producto.
 * @return object producto buscado.
 */
function consultarProducto($id){
    global $conProyecto;  // Es varable global para poder tener acceso.
    $consulta = "SELECT * FROM producos WHERE id = :i";
    $stmt1 = $conProyecto->prepare($consulta);
    try{
        $stmt1->execute([':i' => $id]);
    }catch(PDOException $e){
        die("Error al recuperar productos: " . $e->getMessage());
    }

    // La consulta devuelve una solo fila, no es necesario recorrerla.
    $producto = $stmt1->fetch(PDO::FETCH_OBJ);
    $stmt1 = null;
    return $producto;
}

/**
 * Cierra la conexión con la base de datos.
 * 
 * @param PDO $con identificador de la conexión a la BD.
 */
function cerrar(&$con){
    $con = null;
}

/**
 * Cierra la conexión con la base de datos y con el statement.
 * 
 * @param PDO $con referecia con la BD.
 * @param PDO $st consulta preparada.
 */
function cerrarTodo(&$con, &$st){
    $con = null;
    $st = null;
}

?>