<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAW04 Tarea - Mostar prefencias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary">

    <main class="contanier mt-5">
        <section class="row justify-content-center">
            <div class="card col-4 p-0 bg-success text-white">
                <div class="card-header">
                    <h3>
                        <i class="fa-solid fa-user-gear me-2"></i>
                        Preferencias
                    </h3>
                </div>
                <div class="card-body">

                    <?php
                    // Borrado de los datos de sesión
                    // El mensaje solo se muestra si se ha hecho la petición
                    // por POST para borrar los datos de la sesión.
                    // Si se viene directamente desde "preferencias", no se muestra.
                    if (isset($_POST["borrar-preferencias"])):

                        // si existen las variables de sesión, se borran 
                        // y se muestra el mensaje
                        if (
                            isset($_SESSION["idioma"]) &&
                            isset($_SESSION["zona-horaria"]) &&
                            isset($_SESSION['perfil-publico'])
                        ) {
                            unset($_SESSION["idioma"]);
                            unset($_SESSION["zona-horaria"]);
                            unset($_SESSION["perfil-publico"]);
                            $mensaje = "Preferencias borradas";
                        } else {
                            // Si no hay variables de sesión, se muestra el mensaje 
                            // y no se borra nada
                            $mensaje= "Debes fijar primero las preferencias";
                        }

                        ?>
                        <h4 class="text-warning"><?=$mensaje?></h4>
                    <?php endif; ?>

                    <ul class="list-unstyled">
                        <li>Idioma:
                            <?= isset($_SESSION["idioma"]) ? $_SESSION["idioma"] : "" ?>
                        </li>
                        <li>Perfil público:
                            <?= isset($_SESSION["zona-horaria"]) ? $_SESSION["zona-horaria"] : "" ?>
                        </li>
                        <li>Zona horaria:
                            <?= isset($_SESSION["perfil-publico"]) ? $_SESSION["perfil-publico"] : "" ?>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="preferencias.php" class="btn btn-primary me-2">Establecer</a>
                        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                            <input type="hidden" name="borrar-preferencias" value="true">
                            <input type="submit" value="Borrar" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>