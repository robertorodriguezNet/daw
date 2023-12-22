<?php
session_start();
require_once 'conexion.php';

/**
 * Redirecciona hacia login.php almacenando un mensaje en la sesión.
 * Se sale de la ejecución del script.
 */
function error($mensaje)
{
    $_SESSION['error'] = $mensaje;
    header('location:login.php');
    die();
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 04 - Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- css Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <?php

    // Vamos a loguear al usuario
    if (isset($_POST['login'])) {

        $nombre = trim($_POST['usuario']);
        $pass = trim($_POST['pass']);

        // Validar los campos: mínimo de 3 caracteres
        if (strlen($nombre) <= 2 || strlen($pass) <= 3) {
            error("Error, El nombre o la contraseña no pueden contener solo espacios en blancos.");
        }

        // Seguimos bien, ahora codificamos la clave
        $pass1 = hash('sha256', $pass);

        // Montamos la consulta
        $consulta = "SELECT * FROM usuarios WHERE usuario = :u AND pass = :p";
        $stmt = $conProyecto->prepare($consulta);

        try {
            $stmt->execute([
                ':u' => $nombre,
                ':p' => $pass1
            ]);
        } catch (PDOException $e) {
            cerrarTodo($conProyecto, $stmt);
            error("Error al validar el usuario: " . $e->getMessage());
        }

        // La consulta se ha ejecutado con éxito
        cerrarTodo($conProyecto, $stmt);
        $_SESSION['nombre'] = $nombre;
        header('location:listado.php');

    } else { ?>

        <header class="container my-5">
            <h1>Tema 4 - Tienda</h1>
        </header>

        <main class="container my-5">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" name="login" method="post">
                            <div class="input-group form-group my-3">
                                <div class="input-group-prepend d-flex align-items-center">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="usuario" name='usuario' required>
                            </div>
                            
                            <div class="input-group form-group my-3">
                                <div class="input-group-prepend d-flex align-items-center">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="contraseña"
                                    required>
                            </div>
                            <div class="form-group my-3 text-end">
                                <input type="submit" value="Login" name="login" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mt-3 text-danger font-wegiht-bold text-lg">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
        </main>

        <footer>

        </footer>

    <?php } ?>

</body>

</html>