<?php

namespace Clases;

use PDO;
use PDOException;

class Conexion
{

    private static $host = 'localhost';
    private static $db = 'tarea6';
    private static $user = 'gestor';
    private static $pass = 'secreto';


    /**
     * Crea la conexión con la base de datos.
     * @return PDO Objeto PDO con la conexión
     */
    public static function getConexion(): PDO
    {
        try {

            $dsn = $dsn = "mysql:host=".self::$host.";dbname=".self::$db.";charset=utf8mb4";
            $conexion = new PDO($dsn, self::$user, self::$pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }

        return $conexion;
    }

    public static function getHost(){
        return self::$host;
    }

}
