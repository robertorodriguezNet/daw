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
 * Conecta con la base de datos mediante PDO y devuelve
 * el objeto.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 * @param $sdn es el nombre del origen de los datos.
 * @param $user nombre del usuario de la base de datos.
 * @param $pass clave del usuario en la base de datos.
 * @return PDO objeto con la conexión a la base de datos.
 */
function getConexion($dsn, $user, $pass)
{
    // Intentar la conexión a la base de datos
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
 * @param PDO $cnx objeto con la conexión a la base de datos.
 * @param string $consulta que se debe ejecutar.
 * @param string $mensaje que se muestra en caso de error.
 */
function ejecutarConsulta($cnx, $consulta, $mensajeOk, $mensajeKo)
{
    try {
        $cnx->beginTransaction();
        if ($cnx->exec($consulta)) {
            $cnx->commit();
            confirmarTransaccion($mensajeOk);
        } else {
            $cnx->rollBack();
            confirmarTransaccion($mensajeKo);
        }
    } catch (PDOException $e) {
        mostrarExcepcion($mensajeKo, $e);        
    }
}