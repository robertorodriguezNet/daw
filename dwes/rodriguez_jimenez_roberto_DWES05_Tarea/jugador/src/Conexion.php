<?php
namespace Clases;

use PDO;
use PDOException;

class Conexion
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;

    protected $conexion;

    /**
     * Constructor de la clase.
     * Requiere los parámetros necesarios para crear una conexión mediante PDO.
     */
    public function __construct()
    {

        $this->host = 'localhost';
        $this->db = 'practicaunidad5';
        $this->user = 'gestor';
        $this->pass = 'secreto';

        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        $this->conexion = $this->crearConexion();

    }

    /**
     * Crea la conexión con la base de datos.
     * @return PDO Objeto PDO con la conexión
     */
    private function crearConexion():PDO
    {
        try {

            $conexion = new PDO($this->dsn, $this->user, $this->pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }

        return $conexion;
    }


}

