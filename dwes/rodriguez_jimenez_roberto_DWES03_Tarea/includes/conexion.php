<?php

// La conexión con la base de datos se hace mediante PDO

// Datos de conexión a la base de datos
$host = "localhost";
$port = 3306;
$db = "proyecto";
$user = "gestor";
$pass = "secreto";

// Data Source Name (Nombre de Origen de los Datos)
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
    // Intentar la conexión a la base de datos
    $dsn = $GLOBALS['dsn'];
    $user = $GLOBALS['user'];
    $pass = $GLOBALS['pass'];

    try {
        $cnx = @new PDO($dsn, $user, $pass);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
    } catch (PDOException $e) {
        die(
            "<div class='container my-3'>
            <div class='row justify-content-center'>
                <div class='col text-center'>
                    <h2>No se ha podido conectar con la base de datos</h2>
                </div>
            </div>
        </div>"
        );
    }
}

/**
 * Ejecuta la consulta recibida como parámetro.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 * @see getConexion() obtiene la conexión con la base de datos.
 * 
 * @param string $consulta que se debe ejecutar.
 * @return boolean resultado de la transacción
 */
function ejecutarConsulta($consulta)
{
    // Obtener la conexión
    $cnx = getConexion();
    
    try {
        $cnx->beginTransaction();
        if ($cnx->exec($consulta)) {
            $cnx->commit();
            return true;
        } else {
            $cnx->rollBack();
            return false;
        }
    } catch (PDOException $e) {
        return false;        
    }
}