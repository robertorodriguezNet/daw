<?php

class Conexion
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;

    protected $conexion;

    public function __construct()
    {

        $this->host = 'localhost';
        $this->db = 'practicaunidad5';
        $this->user = 'gestor';
        $this->pass = 'secreto';

        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        $this->conexion = $this->crearConexion();

    }

    private function crearConexion()
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

