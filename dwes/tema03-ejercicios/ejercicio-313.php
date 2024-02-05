<?php 

function getConnection(): mysqli{

    global $host, $db, $user, $pass;
    @$connection = mysqli_connect($host,$user,$pass,$db);

    // Hay que comprobar que la conexión sea correcta
    $error = $connection->connect_errno;
    
    // Si se ha producido un error, lanzamos una excepción
    if($error != null ){
        throw new Exception("Error al conectar con la base de datos: " . $connection->connect_error);
    }

    return $connection;
}

// Datos de conexión
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEWS - Ejercicio 3.1.3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <h1 class="text-center">Transacciones</h1>
    <h2 class="text-center">Tema 3.1.3</h2>

    <section class="container d-flex justify-content-center p-2">
        <div class="card bg-warning-subtle border-2">
            <div class="card-body">
                <div class="card-title">
                    Enunciado
                </div>

            </div>
            <div class="card-text p-2">
                <p>
                    Según la información que figura en la tabla stock de la base de datos proyecto, la tienda 1
                    (CENTRAL)
                    tiene 2 unidades del producto de código 3DSNG y la tienda 3 (SUCURSAL2) ninguno. Suponiendo que los
                    datos son esos (no hace falta que los compruebes en el código), utiliza una transacción para mover
                    una
                    unidad de ese producto de la tienda 1 a la tienda 3.
                </p>
            </div>
        </div>
    </section>

    <section class="container">
        <article>
            <p>
                La operación se va realizar con MySQL.
            </p>
            <p>
                Mostrar los datos de los productos antes de la transacción.
            </p>
            
            <?php 
                
                try{
                    $connection = getConnection();
                }catch(Exception $e){
                    echo 'Error al conectar con la base de datos: ' . $e->getMessage();
                }

            ?>
        </article>
    </section>

</body>

</html>