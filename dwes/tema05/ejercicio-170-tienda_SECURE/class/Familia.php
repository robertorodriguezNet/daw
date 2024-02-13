<?php 

class Familia extends Conexion{

    private $cod;
    private $nombre;

    public function __construct(){
        parent::__construct();
    }

    public function recuperarFamilias():PDOStatement{

        $consulta = "SELECT * FROM familias ORDER BY nombre";
        $stmt = $this->conexion->prepare($consulta);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error al recuperar las familias de productos: " . $e->getMessage() );
        }
        return $stmt;
    }
}