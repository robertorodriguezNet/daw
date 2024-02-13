<?php

Class Usuario extends Conexion{

    private $usuario;
    private $pass;

    public function __construct(){
        parent::__construct();
    }
     
    /**
     * Comprueba la existencia de una usuario.
     */
    public function isValido(string $u, string $p): bool{

        $pass = hash('sha256', $p);
        $consulta = "SELECT * FROM usuarios WHERE usuario=:u AND pass=:p";
        $stmt = $this->conexion->prepare($consulta);
        try{

            $stmt->execute([
                ':u' => $u,
                ':p' => $pass
            ]);

        }catch(PDOException $e){
            die("Error al consultar usuario: " . $e->getMessage() );
        }

        return ($stmt->rowCount() >= 1);
    }



}