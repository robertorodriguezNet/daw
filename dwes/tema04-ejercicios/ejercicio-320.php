<?php
// Pedir los datos si no se ha autenticado
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido Protegido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Datos Incorrectos o Usuario NO reconocido!!!";
    die();
}

session_start();  // Iniciar la sesión

// No existe la variable de sesión usuario.
if (!isset($_SESSION['usuario'])) {

    include('includes/db.php');
    if (existsUser() && isUserValid()) {
        $_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
    } else {
        header('WWW-Authenticate: Basic Realm="Contenido Protegido"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Datos Incorrectos o Usuario NO reconocido!!!";
        die();
    }

}
// El usuario ya se identificó
else {
    setlocale(LC_ALL, 'es_ES.UTF-8');
    date_default_timezone_set('Europe/Madrid');
    $fecha = ("Tu última visita fue el " . date('d/m/Y H:i:s'));

    // El usuario puede llegar para ver la página o para borrar los datos
    if (isset($_POST['borrar'])) {
        unset($_SESSION['visitas']);
    } else {
        // Agregamos la visita
        $_SESSION['visitas'][] = $fecha;
    }

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

        <div class="col">

            <?php
            if (!isset($_SESSION['visitas'])) {
                echo '<p>Bienvenido, es tu primera visita.</p>';
            } else {
                echo '<ul>';
                foreach ($_SESSION['visitas'] as $visita) {
                    echo "<li>$visita</li>";
                }
                echo '</ul>';
            }
            ?>

        </div>

        <div class="col">
            <form name="borrar-datos" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" value="Borrar datos" name="borrar" class="btn btn-warning">
            </form>
        </div>


    </div>

</body>

</html>