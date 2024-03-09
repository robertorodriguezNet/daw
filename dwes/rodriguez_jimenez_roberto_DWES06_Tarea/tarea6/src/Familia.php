<?php
namespace Clases;

class Familia
{

    private $cod;
    private $nombre;

    public function __construct(){

    }

    /* -- GETTERS -------------------------------------- */
    public function getCod():string{
        return $this->cod;
    }

    public function getNombre():string{
        return $this->nombre;
    }

    /* -- SETTERS -------------------------------------- */
    public function setCod(string $arg){
        $this->cod = $arg;
    }

    public function setNombre(string $arg){
        $this->nombre = $arg;
    }

    public function __toString(){
        return $this->cod . " " . $this->nombre;
    }
}