<?php
$host = 'localhost';
$db = 'proyecto';
$user = 'gestor';
$pass = 'secreto';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

/*
    admin/secreto
    gestor/pass
*/

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
 * @return boolean [true|false] si el usuario existe o no.
 */
function existsUser()
{
    $cnx = getConexion();

    $consulta = "SELECT * FROM usuarios WHERE usuario = :u";

    $stmt = $cnx->prepare($consulta);
    try{

        $stmt->execute([
            ':u' =>$_SERVER['PHP_AUTH_USER']
        ]);

    }catch(PDOException $e){
        $cnx = null;
        die('No se ha podido ejecutar la consulta: ' . $e->getMessage());
    }

    $exist = $stmt->rowCount() > 0;

    $cnx = null;
    $stmt = null;

    return $exist;
}

/**
 * Validar un usuario a través del nombre de usuario y de la clave.
 * 
 * @return boolean true|false si el usuario existe o no.
 */
function isUserValid()
{
    $cnx = getConexion();

    $consulta = "SELECT * FROM usuarios WHERE usuario = :u AND pass = :p";

    // Crear el statement
    $stmt = $cnx->prepare($consulta);

    // Ejecutar la consulta
    try {
        $stmt->execute([
            ':u' => $_SERVER['PHP_AUTH_USER'],
            ':p' => hash('sha256', $_SERVER['PHP_AUTH_PW'])
        ]);
    } catch (PDOException $e) {
        $cnx =null;
        die("Error al recuperar los datos: " . $e->getMessage());
    }

    // Comprobar el resultado de la consulta
    $isValid = ( $stmt->rowCount() > 0);
     
    $cnx = null;
    $stmt = null;

    return $isValid;
     
}

?>