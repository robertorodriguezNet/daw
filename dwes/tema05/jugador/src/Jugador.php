<?php 

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

    public function __toString():string{
        return "Jugador: " . "(" . $this->dorsal . ") " . $this->nombre . " " . $this->apellidos;
    }

    /**
     * Devuelve el conjunto de registros de jugadores.
     * @return PDOStatement resuldato de la consulta.
     */
    public function getListadoJugadores():PDOStatement{

        $consulta = "SELECT * FROM jugadores ORDER BY dorsal";
            $stmt = $this->conexion->prepare($consulta);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error al recuperar el listado de los jugadores: " . $e->getMessage() );
        }
        return $stmt;

    }

    /**
     * Comprueba si la tabla jugadores está vacía.
     * @return bool true|false si está o no vacía.
     */
    public function isEmptyJugadores():bool{
        return $this->getListadoJugadores()->rowCount() == 0;
    }
}