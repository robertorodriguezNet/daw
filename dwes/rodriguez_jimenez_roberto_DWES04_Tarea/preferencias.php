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

<!-- <body class="bg-secondary d-flex justify-content-center align-items-center my-auto"> -->

<body class="bg-secondary">

    <main class="container d-flex justify-content-center">
        <section class="card mt-5 col-4 col-md-8 col-sm-12">
            <div class="card-header">
                <h3>Preferencias de usuario</h3>
            </div>
            <div class="card-body">
            <form action="<?= $_SERVER["PHP_SELF"] ?>" name="establecer" method="post">
                <div><label for="idioma">Idioma</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fas fa-language"></i></span>
                    <select name="idioma" id="idioma" class="form-control">
                        <option value="espanol">Español</option>
                        <option value="ingles">Inglés</option>
                    </select>
                </div>
                <div><label for="publico">Perfil público</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    <select name="publico" id="publico" class="form-control">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div><label for="hora">Zona horaria</label></div>
                <div class="input-group form-group mb-3">                    
                    <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                    <select name="hora" id="hora" class="form-control">
                        <option value="gtm-2">GMT-2</option>
                        <option value="gtm-1">GMT-1</option>
                        <option value="gtm">GMT</option>
                        <option value="gtm+1">GMT+1</option>
                        <option value="gtm+2">GMT+2</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">                    
                    <a href="mostrar.php" class="btn btn-primary">Mostar preferencias</a>
                    <input type="submit" value="Establecer Preferencias" class="btn btn-success">
                </div>
            </form>
        </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>