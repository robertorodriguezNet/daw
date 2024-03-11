<?php
namespace Clases;

use PDO;

/**
 * Gestión del stock de un producto en una tienda.
 * 
 * @method void initStock()
 */
class Stock extends Conexion
{
    /**#@+
     * @access private
     * @var int
     */
    private $producto;
    private $tienda;
    private $unidades;
    /**#@-*/

    /**
     * Constructor de la clase.
     * 
     * @param int $idProducto
     * @param int $idTienda
     */
    public function __construct(int $idProducto = null, int $idTienda = null){

        parent::__construct();

        // Sólo creamos el objeto si tenemos datos
        if( ($idTienda != null) && ($idProducto != null) ){
            $this->tienda   = $idTienda;
            $this->producto = $idProducto;
            $this->unidades = $this->initStock();
        }else{
            // Inicializamos a 0 las unidades para que la declaración de 
            //getUnidades() no marque un error.
            $this->unidades = 0;
        }

    }

    /**
     * Establecemos el stock a partir de los identificadores
     * del producto y de la tienda.
     * 
     * @access private
     * @return int 
     */
    private function initStock():int{

        $consulta = "SELECT unidades FROM stocks 
            WHERE producto = ". $this->producto . " AND tienda = " . $this->tienda;

        $conexion  = $this->conexion;
        $resultado = $conexion->query($consulta);
        $unidades  = $resultado->fetch(PDO::FETCH_OBJ);
        $conexion  = null;

        return $unidades->unidades;

    }

    // -- GETTERS ----------------------------------------------------- 
    public function getProducto():int {
        return $this->producto;
    }
    public function getTienda():int {
        return $this->tienda;
    }
    public function getUnidades():int{
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