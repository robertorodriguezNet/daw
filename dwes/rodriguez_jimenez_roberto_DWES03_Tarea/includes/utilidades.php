<?php

/**
 * Muestra un mensaje avisando de que ocurrió algún error.
 * Esta función se implkenta en utilidades.php porque puede 
 * depender de otras funciones.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.29
 * @param string $nombre nombre del producto.
 * @param string $nombre_corto nombre corto del producto.
 * @param string $precio del producto, con formato d*.dd
 * @param string $familia a la que pertenece el producto. Es texto.
 * @param string $descripcion del producto.
 * @param string $mensaje que se muestra.
 */
function mostrarElError($nombre, $nombre_corto, $precio, $familia, $descripcion, $mensaje)
{
    // Mostramos un mensaje de error si lo hubiera
    echo "<div class='container'>
        <div class='row justify-content-center'>
            <div class='col text-center'>
                <h1>Ocurrió algún error: $mensaje</h1>
                <h2>Revisa los datos</h2>
                <ul style='list-style: none' class='mx-0 px-0'>
                    <li>$nombre (máx. 200 caracteres)</li>
                    <li>$nombre_corto (máx. 50 caracteres)</li>
                    <li>$precio</li>
                    <li>$familia</li>
                    <li>$descripcion</li>
                </ul>
                <a href='crear.php' class='btn btn-primary'>Volver</a>
            </div>
        </div>
    </div>";
}

/**
 * Valida que los datos del formulario estén completos.
 * Si falta algún dato o está en blanco, se sale de la aplicación.
 * Se asume que conocemos los campos del formulario.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 */
function validarDatosCompletos()
{
    if (
        !((isset($_POST['nombre']) && !empty($_POST['nombre'])) &&
            (isset($_POST['nombre_corto']) && !empty($_POST['nombre_corto'])) &&
            (isset($_POST['precio']) && !empty($_POST['precio'])) &&
            (isset($_POST['familia']) && !empty($_POST['familia'])) &&
            (isset($_POST['descripcion']) && !empty($_POST['descripcion']))
        )
    ) {
        die(
            mostrarElError(
                $_POST['nombre'],
                $_POST['nombre_corto'],
                $_POST['precio'],
                $_POST['familia'],
                $_POST['descripcion'],
                "Falta algún dato."
            )
        );
    }
}

/**
 * Chequea los datos para asegurarse de que no se cuela algún 
 * carácter que no deba estar.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 * @return array[string] con los datos formateados.
 */
function validarFormato()
{
    // Tenemos todos los campos
    // El nombre corto lo convertimos en mayúsculas y eliminamos los espacios en blanco
    $nombre = stripslashes(trim($_POST['nombre']));
    $nombre_corto = stripslashes(
        trim(
            strtoupper(
                str_replace(" ", "", $_POST['nombre_corto'])
            )
        )
    );
    $precio = stripslashes(trim($_POST['precio']));
    $familia = stripslashes(trim($_POST['familia']));
    $descripcion = stripslashes(trim($_POST['descripcion']));

    // Comprobamos que el precio tenga el punto
    if (!preg_match('/\./', $precio)) {
        $precio .= ".00";
    }

    if (
        !(
            preg_match("/^[A-ZÁÉÍÓÚa-záéíóú0-9 ]{1,200}$/", $nombre) &&
            preg_match("/^[A-Z0-9]{1,50}$/", $nombre_corto) &&
            preg_match('/^[0-9]*\.[0-9]{2}$/', $precio)
        )
    ) {
        die(
            mostrarElError(
                $nombre,
                $nombre_corto,
                $precio,
                $familia,
                $descripcion,
                "Algún nombre no cumple con el patrón."
            )
        );
    }

    return array(
        'nombre' => $nombre,
        'nombre_corto' => $nombre_corto,
        'pvp' => $precio,
        'familia' => $familia,
        'descripcion' => $descripcion
    );
}

/**
 * Personaliza los errores capturados.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 * @param int $nivel de error.
 * @param string $mensaje que se quiere mostrar.
 */
function gestionarError($nivel, $mensaje)
{

    switch ($nivel) {
        case E_WARNING:
            echo 'Error';
            break;
        default:
            echo 'Error no especificado.';
    }

}