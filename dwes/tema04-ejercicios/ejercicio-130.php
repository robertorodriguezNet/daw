<?php
// Pedir los datos si no se ha identificado
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido Protegido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Datos Incorrectos o Usuario NO reconocido!!!";
    die();
}
include_once('includes/db.php');
if (!existsUser($_SERVER['PHP_AUTH_USER']) || !isPassValid($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic Realm="Contenido Protegido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Datos Incorrectos o Usuario NO reconocido!!!";
    die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.2.0</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <h1 class="text-center my-3">Directivas PHP_AUTH</h1>

    <div class="container bg-secundary">

        <div class="card text-white bg-primary my-3">
            <div class="card-header text-center fw-bold">PHP_AUTH</div>
            <div class="card-body">
                <p>Usuario:
                    <?= $_SERVER['PHP_AUTH_USER'] ?>
                </p>
                <p>Contraseña:
                    <?= $_SERVER['PHP_AUTH_PW'] ?>
                </p>
            </div>
        </div>

    </div>

</body>

</html>