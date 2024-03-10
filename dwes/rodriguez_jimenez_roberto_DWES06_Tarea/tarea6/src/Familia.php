<?php
namespace Clases;

class Familia
{
    private $codigo;
    private $nombre;

    public function __construct(){

    }

    // -- GETTERS ----------------------------------------------------- 
    public function getCodigo():string{
        return $this->codigo;
    }
    public function getNombre():string{
        return $this->nombre;
    }

    // -- SETTERS ----------------------------------------------------- 
    public function setCodigo(string $arg):void{
        $this->codigo = $arg;
    }
    public function setNombre(string $arg):void{
        $this->nombre = $arg;
    }

    public function __toString(){
        return $this->codigo . ' ' . $this->nombre;
    }
}