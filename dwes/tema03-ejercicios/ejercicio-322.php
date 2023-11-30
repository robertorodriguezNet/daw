<?php

// Utiliza PDO para repartir entre las tiendas las tres unidades que hay de 
// PAPYRE62GB en la tienda 1

// |______________________________|
// | producto | tienda | unidades |
// |----------|--------|----------|
// |    15    |    1   |    2     | 
// |    15    |    2   |    0     |
// |    15    |    3   |    1     |
// |__________|________|__________|

// Preparamos los datos
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";

// DSN: Data Source Name (nombre de origen de datos)
// Especificar el driver: mysql.
// Se podría especificar el puerto.
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// Crear el objeto PDO.
// Para cerrar la conexión hay que eliminar el objeto.
$conn = new PDO($dsn, $user, $pass);

// Establecemos que el error se muestre como un warning.
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Consultas
// Quitar 1 de la tienda 1
$consultaTienda1 = "UPDATE stocks SET unidades = 1 WHERE (SELECT id FROM productos WHERE nombre_corto='PAPYRE62GB') AND tienda=1";
$consultaTienda2 = "INSERT INTO stocks (producto,tienda,unidades) VALUES ((SELECT id FROM productos WHERE nombre_corto='PAPYRE62GB'),2,1)";

// Versión corta:
$consultaTienda2Corta= "INSERT INTO stock SELECT id, 2, 1 FROM productos WHERE nombre_corto='PAPYRE62GB')";

// mensajes
$MESSAGES = [
    "ok" =>"<p>
        Los datos se han actualizado correctamente.
    </p>",
    "ko" =>"<p class='text-danger'>
        No se han podido actualizar los datos.
    </p>"
];
$message = $MESSAGES['ok'];

// Iniciamos la transacción.
// beginTransaction() desactiva autocommit.
$conn->beginTransaction();

// Ejecutamos la primera consulta.
// Las variables recogen true|false.
$isTienda1Ok = ($conn->exec($consultaTienda1));
$isTienda2Ok = ($conn->exec($consultaTienda2));

if($isTienda1Ok && $isTienda2Ok){
    $conn->commit();
    $message = $MESSAGES['ok'];
}else{
    $conn->rollBack();
    $message = $MESSAGES['ko'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
    <h1 class="text-center">Ejercicio 3.2.2</h1>
    <h2 class="text-center">Uso de transacciones con PDO</h2>

    <div class="container mt-3 text-center">
        <p>
            <?= $message ?>
        </p>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    // Eliminar la conexión.
    $conn = null;
?>