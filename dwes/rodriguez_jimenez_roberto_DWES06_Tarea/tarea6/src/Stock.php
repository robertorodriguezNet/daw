<?php
namespace Clases;

class Stock
{
    private $producto;
    private $tienda;
    private $unidades;

    public function __construct(){

    }

    // -- GETTERS ----------------------------------------------------- 
    public function getProducto():int {
        return $this->producto;
    }
    public function getTienda():int {
        return $this->tienda;
    }
    public function getUnidades():int {
        return $this->unidades;
    }

    // -- SETTERS ----------------------------------------------------- 
    public function setProducto(int $arg):void{
        $this->producto = $arg;
    }
    public function setTienda(int $arg):void{
        $this->tienda = $arg;
    }
    public function setUnidades(int $arg):void{
        $this->unidades = $arg;
    }

    public function __toString(){
        return $this->producto . ' ' . $this->tienda . ' ' . $this->unidades;
    }
}