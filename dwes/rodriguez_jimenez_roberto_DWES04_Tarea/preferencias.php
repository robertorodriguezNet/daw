<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAW04 Tarea - Establecer Prefencias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary d-flex justify-content-center align-items-center my-auto">

    <div class="card col-4 mt-5">
        <div class="card-header">
            <h3>Preferencias de usuario</h3>
        </div>
        <div class="card-body">
            <form action="<?= $_SERVER["PHP_SELF"] ?>" name="establecer" method="post">
                <div><label for="idioma">Idioma</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Idioma" name='idioma' required>
                </div>
                <div><label for="idioma">Perfil público</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Idioma" name='idioma' required>
                </div>
                <div><label for="idioma">Zona horaria</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Idioma" name='idioma' required>
                </div>
                <div class="d-flex justify-content-between">                    
                    <a href="mostrar.php" class="btn btn-primary">Mostar preferencias</a>
                    <input type="submit" value="Establecer Preferencias" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>