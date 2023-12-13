<?php
$host = 'localhost';
$db = 'proyecto';
$user = 'gestor';
$pass = 'secreto';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

/**
 * Conecta con la base de datos mediante PDO y devuelve el objeto.
 * 
 * Si la operación falla, se sale de la aplicación.
 * Usa variables globales para obtener los datos de conexión a la BD.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 *  
 * @global string dsn es nombre del origen de los datos.
 * @global string user autorizado en la base de datos.
 * @global string pass clave del usuario.
 * @return PDO objeto con la conexión a la base de datos.
 */
function getConexion()
{

    try {

        $cnx = new PDO($GLOBALS['dsn'], $GLOBALS['user'], $GLOBALS['pass']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
        return $cnx;

    } catch (PDOException $e) {
        die('Error al conectar con la base de datos');
    }

}

/**
 * Comprueba si un usuario existe en la tabla usuarios
 * 
 * @param string $user es el usuario buscado.
 * @return boolean [true|false] si el usuario existe o no.
 */
function existsUser($user)
{
    $cnx = getConexion();

    $consulta = "SELECT count(*) as existe FROM usuarios WHERE usuario = '$user'";

    try {
        // Como no vamos a modificar ningún dato, no necesitamos 
        // beginTransaction()

        // La consulta devuelve un solo registro, con la cantidad de 
        // registros encontrados que coinciden con el parámetro buscado.
        $result = $cnx->query($consulta);
        $count = $result->fetch(PDO::FETCH_OBJ);

        // Eliminar el objeto
        $cnx = null;
        return $count->existe >= 1;

    } catch (PDOException $e) {
        return false;
    }
}

function isPassValid($user, $pass)
{
    $cnx = getConexion();

    $consulta = "SELECT count(*) as existe FROM usuarios WHERE usuario = '$user' AND pass = sha2('$pass',256)";

    try {
        // Como no vamos a modificar ningún dato, no necesitamos 
        // beginTransaction()

        // La consulta devuelve un solo registro, con la cantidad de 
        // registros encontrados que coinciden con el parámetro buscado.
        $result = $cnx->query($consulta);
        $count = $result->fetch(PDO::FETCH_OBJ);

        // Eliminar el objeto
        $cnx = null;
        return $count->existe >= 1;

    } catch (PDOException $e) {
        return false;
    }
}

?>