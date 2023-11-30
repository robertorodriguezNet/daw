<?php 

$host = 'localhost';
$port = 3306;
$user = 'gestor';
$pass = 'secreto';
$db = 'proyecto';

$producto = '3DSNG';
$moverDe = 1;
$moverA = 3;

$error = false;

// Conectar con la base de datos
@$cnxDb = mysqli_connect($host,$user,$pass,$db);

// Si hay error se cierra la app
if($cnxDb->connect_error){
    die('Error en la conexión: '.$cnxDb->connect_error);
}

// Continuamos

// Desactivar el autocommit
$cnxDb->autocommit(FALSE);

// Consulta para eliminar un producto de la tienda 1
$query = "UPDATE stocks SET unidades = 1 
            WHERE 
            producto = (SELECT id FROM productos WHERE nombre_corto = '$producto')
            AND tienda = " . $moverDe;

// Ejecutar la consulta
if(!$cnxDb->query($query)){
    $error = true;
}

// Insertar en stocks un producto 3DSNG en la tienda 3
// SELECT devuelve el id, y los valores 3 y 1
$query = "INSERT INTO stocks (producto, tienda, unidades)
            SELECT id, $moverA, 1 FROM
                productos  WHERE nombre_corto ='$producto'";
        
// Ejecutar la consulta
if(!$cnxDb->query($query)){
    $error = true;
}

// Se han ejecutado las consultas, pero no se han confirmado.
// Si no hay error, se confirman.
if($error){
    $cnxDb->rollback();
}else{
    $cnxDb->commit();
}

// Si hemos llegado hasta aquí, es que la conexión fue correcta
$cnxDb->close();

?>