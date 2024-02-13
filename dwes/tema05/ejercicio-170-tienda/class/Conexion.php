<?php 
 class Conexion{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;

    // Puede ser llamada desde cualquier subclase
    protected $conexion;

    public function __construct(){
        $this->host = "localhost";
        $this->db = "proyecto";
        $this->user = "gestor";
        $this->pass = "secreto";

        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        $this->conexion = $this->crearConexion(); 
    }

    public function crearConexion(){

        try{
 
            $conexion = new PDO($this->dsn, $this->user,   $this->pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die("Error en la conexión: " . $e->getMessage() );
        }

        return $conexion;

    }
 }