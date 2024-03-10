<?php
namespace Clases;

use PDO;

class Producto extends Conexion
{
    private $id;
    private $nombre;
    private $nombre_corto;
    private $descripcion;
    private $pvp;
    private $familia;

    public function __construct(){
        parent::__construct();
    }

    // -- GETTERS ----------------------------------------------------- 
    public function getId():int{
        return $this->id;
    }
    public function getNombre():string{
        return $this->nombre;
    }
    public function getNombrCorto():string{
        return $this->nombre_corto;
    }
    public function getDescripcion():string{
        return $this->descripcion;
    }
    public function getPvp():float{
        return $this->pvp;
    }
    public function getFamilia():string{
        return $this->familia;
    }

    // -- SETTERS ----------------------------------------------------- 

    /**
     * Recupera los datos del producto desde la base de datos.
     */
    public function setProducto(int $id):void{

        $consulta = "SELECT * FROM productos WHERE id = $id";
        $resultado = $this->conexion->query($consulta);
        $producto = $resultado->fetch(PDO::FETCH_OBJ);

        $this->nombre = $producto->nombre;
        $this->nombre_corto = $producto->nombre_corto;
        $this->descripcion = $producto->descripcion;
        $this->pvp = $producto->pvp;
        $this->familia = $producto->familia;

    }

    public function setId(int $arg):void{
        $this->id = $arg;
    }
    public function setNombre(string $arg):void{
        $this->nombre = $arg;
    }
    public function setNombreCorto(string $arg):void{
        $this->nombre_corto = $arg;
    }
    public function setDescripcion(string $arg):void{
        $this->descripcion = $arg;
    }
    public function setPvp(float $arg):void{
        $this->pvp = $arg;
    }
    public function setFamilia(string $arg):void{
        $this->familia = $arg;
    }

    public function __toString(){
        return $this->id . ' ' . 
            $this->nombre . ' ' . 
            '(' . $this->nombre_corto . ') ' . 
            $this->descripcion . ' ' . 
            $this->pvp . ' € ' . 
            $this->familia;
    }
}