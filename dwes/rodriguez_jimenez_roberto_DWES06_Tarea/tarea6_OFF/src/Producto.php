<?php

namespace Clases;

class Producto
{
    private $id;
    private $nombre;
    private $nombreCorto;
    private $descripcion;
    private $pvp;
    private $familia;

    public function __construct()
    {
    }

    /* -- GETTERS -------------------------------------- */
    public function getId(): int{
        return $this->id;
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getNombreCorto(): string{
        return $this->nombreCorto;
    }
    public function getDescripcion(): string{
        return $this->descripcion;
    }
    public function getPVP(): float{
        return $this->pvp;
    }
    public function getFamilia(): string{
        return $this->familia;
    }

    /* -- SETTERS -------------------------------------- */
    public function setNombre(string $args){
        $this->nombre = $args;
    }

    public function setNombreCorto(string $args){
        $this->nombreCorto = $args;
    }

    public function setDescripcion(string $args){
        $this->descripcion = $args;
    }

    public function setPVP(float $args){
        $this->pvp = $args;
    }
    public function setFamilia(string $args){
        $this->familia = $args;
    }


    public function __toString(){
        return $this->id . " " . 
        $this->nombre . " " .
        $this->nombreCorto . " " .
        $this->pvp . " " . 
        $this->familia
    }
}
