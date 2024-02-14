<?php 

require_once '../src/Conexion.php';
class Jugador extends Conexion
{
    private $id;
    private $nombre;
    private $apellidos;
    private $dorsal;
    private $poscion;
    private $barcode;
    
    public function __construct(){
        parent::__construct();
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;
    }

    public function setPoscion($poscion)
    {
        $this->poscion = $poscion;
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    public function __toString(){
        return "Jugador: " . "(" . $this->dorsal . ") " . $this->nombre . " " . $this->apellidos;
    }
}