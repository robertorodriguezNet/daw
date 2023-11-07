<?php

/**
 * Función que valida el formulario recipido por post
 * @return mixed devulve un array con el id de los errores encontrados.
 */
function validarFormulario()
{

    $errores = [];

    // Validar el nombre si se ha recibido.
    if (!isset($_POST["nombre"]) || empty($_POST['nombre'])) {
        $errores[] = 0;
    } else if (!validarNombre($_POST['nombre'])) {
        $errores[] = 1;
    }

    // Validar el teléfono si se ha recibido.
    // El teléfono no es obligatorio, por lo que se valida solo si ha sido recibido.
    if (
        isset($_POST["telefono"])
        && !empty($_POST['telefono'])
        && !validarTelefono($_POST["telefono"])
    ) {
        $errores[] = 3;
    }

    return $errores;

}

/**
 * Función que actualiza la agenda a partir de la agenda recibida 
 * como parámetro y los datos recibidos por post.
 * @param mixed $datos contiene un array [nombre]:teléfono
 * @param string $nombre es el nombre del contacto que se guaradará en la agenda
 * @param string $telefono número asociado al contacto
 */
function procesarAgenda($datos, $nombre, $telefono)
{
    $agenda = $datos;

    // si se ha recibido el nombre y el teléfono
    if (!empty($nombre)) {

        if (!empty($telefono)) {
            // Tanto si el nombre ya existe como si es nuevo, se asigna el teléfono al nombre.
            $agenda[$nombre] = $telefono;
        } else {
            // Teléfono vacío, se borra el registro
            unset($agenda[$nombre]);
        }

    }

    return $agenda;
}

/**
 * Función que devuelve el error pedido.
 * Se especifican errores que podrían no producirse, pero ya quedan indicados.
 */
function getError($err)
{
    $errores = [
        0 => "El nombre es obligatorio",
        1 => "No es un nombre válido",
        2 => "El teléfono es obligatorio",
        3 => "El número de teléfono no es válido"
    ];

    return $errores[$err];
}



/**
 * Valida el nombre del usuario recibido como parámetro.
 * La longitud mínima del nombre es de 3 caracteres.
 * @return boolean true si el nombre es válido
 */
function validarNombre($nombre)
{

    // Eliminar espacios inicial y final
    $temp = trim($nombre);

    // Sustituir las tildes
    $temp = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $temp);

    // Comprobar que unicamente contenga letras o espacios en blanco
    // preg_match devuelve 1 si encuentra el patrón
    $pattern = "/^[a-zA-Z ]+$/";
    return ((preg_match($pattern, $temp) == 1) && (strlen($temp) >= 3)) ? true : false;

}
                       
/**
 * Valida el número de teléfono.
 * @return boolean true si el número de teléfono es válido.
 */
function validarTelefono($telefono)
{
    $pattern = "/^[0-9]{9}$/";
    return (preg_match($pattern, $telefono) == 1) ? true : false;
}

?>