<?php
include("funciones.inc.php");

// Declaramos un array agenda
$agenda = [];

// Crear una variable para comprobar el error rápidamente.
// En caso de haber error, debemos recuperar los campos tal y como estaban.
$hayError = false;

// Comprobar si existen datos recibidos desde el formulario para poder procesarlos
if (count($_POST) > 0) {

    // Validamos el formulario y recibimos un array con 
    // los id de los errores encontrados.
    $errores = validarFormulario();
    $hayError = count($errores) >= 1;

    // Si no hay errores, procesamos los datos del formulario.
    if (!$hayError) {

        // En este punto sabemos que tenemos los datos del formulario sin errores.
        // Es posible que en la agenda no haya datos aún, por lo que no existirá 
        // el campo $_POST['agenda']

        // procesarDatos 
        // Si la agenda está vacía, no puede existir $_POST['agenda'] ya que no se han 
        // podido crear los campos 'hiddden', entonces enviamos la agenda vacía.
        $agenda = procesarAgenda(
            isset($_POST['agenda']) ? $_POST['agenda'] : $agenda,
            $_POST['nombre'],
            $_POST['telefono']
        );
    } else {
        // Si hay agenda, debemos propagarla, si no se hace, se pierden los datos.
        if (isset($_POST['agenda'])) {
            $agenda = $_POST['agenda'];
        }
    }
}

// Acciones solicitadas por get (vaciar la agenda)
if (count($_GET) > 0) {
    if (isset($_GET['vaciar']) && ($_GET['vaciar'] == 1)) {
        reset($agenda);
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES02. Tarea</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Agenda</h1>

    <?php if ($hayError): ?>
        <div class="error">
            <?php foreach ($errores as $error): ?>
                <?= getError($error) ?><br>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <?php if (count($agenda) >= 1): ?>
        <fieldset>
            <legend>Agenda</legend>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                </tr>
                <?php foreach ($agenda as $key => $value): ?>
                    <tr>
                        <td>
                            <?= $key ?>
                        </td>
                        <td class="telefono">
                            <?= $value ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </fieldset>
    <?php endif ?>

    <fieldset>
        <legend>Nuevo contacto</legend>
        <form action="" method="post">
            <div class="row">
                <div class="col label">
                    <label for="nombre" id="nombre">Nombre:</label>
                </div>
                <div class="col">
                    <input type="text" name="nombre" id="nombre" maxlength="50" placeholder="Mín. 3 caracteres" <?php if ($hayError): ?> value="<?= $_POST['nombre'] ?>" <?php endif ?>>
                </div>
            </div>
            <div class="row">
                <div class="col label">
                    <label for="telefono">Telefono:</label>
                </div>
                <div class="col">
                    <input type="tel" name="telefono" id="telefono" placeholder="123456789" pattern="[0-9]{9}" <?php if ($hayError): ?> value="<?= $_POST['telefono'] ?>" <?php endif ?>>
                </div>
            </div>

            <!-- enviamos la agenda -->
            <?php foreach ($agenda as $key => $value): ?>
                <input type="hidden" name="agenda[<?= $key ?>]" value="<?= $value ?>">
            <?php endforeach ?>

            <div class="botones">
                <input type="submit" value="Añadir contacto" id="anadir">
                <input type="reset" value="Limpiar campos" id="limpiar">
            </div>

        </form>

        </div>
    </fieldset>



    <?php if (count($agenda) >= 1): ?>
        <form action="" id="form-vaciar" method="get" name="form-vaciar">
            <fieldset>
                <legend>Vaciar agenda</legend>
                <button type="submit" value="1" name="vaciar" id="1">Vaciar</button>
            </fieldset>
        </form>
    <?php endif ?>

</body>

</html>