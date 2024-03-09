<?php
namespace Clases;

class Stock
{
    private $producto;
    private $tienda;
    private $unidades;


    public function __construct(){

    }

    /* -- GETTERS -------------------------------------- */

    public function getProducto(): int{
        return $this->producto;
    }

    public function getTienda(): int{
        return $this->tienda;
    }

    public function getUnidades(): int{
        return $this->unidades;
    }

    /* -- SETTERS -------------------------------------- */

    public function setProducto(int $args){
        $this->producto = $args;
    }


    public function setTienda(int $args){
        $this->tienda = $args;
    }


    public function setUnidades(int $args){
        $this->unidades = $args;
    }
}