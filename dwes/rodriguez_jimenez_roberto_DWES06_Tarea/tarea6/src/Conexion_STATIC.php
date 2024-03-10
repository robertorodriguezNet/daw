<?php
namespace Clases;

use PDO;
use PDOException;

class Conexion_STATIC
{

    private static $host = 'localhost';
    private static $db = 'tarea6';
    private static $user = 'gestor';
    private static $pass = 'secreto';

    public function __construct(){

    }

    public static function getConexion():PDO{

        $dsn = 'mysql:host=' . self::$host . ';dbName=' . self::$db . ';charset=utf8mb4';

        try{
            $conexion = new PDO($dsn, self::$user, self::$pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        }catch(PDOException $e){
            die("Error al conectar con la base de datos: " . $e->getMessage() );
        }

        return $conexion;
    }
}