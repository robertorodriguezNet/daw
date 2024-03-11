<?php
namespace Clases;

use PDO;
use Clases\Conexion;

/**
 * Representa el conjunto de familias de productos.
 * 
 * @method array getFamilias() es un método estático
 */
class Familia 
{

    public function __construct(){
    }

    // -- GETTERS ----------------------------------------------------- 
    
    /**
     * Devuelve la colección de familias almacenadas en la BD.
     * 
     * Es un método estático.
     * 
     * @return array asociativo
     */
    public static function getFamilias():array{

        $consulta = "SELECT * FROM familias";

        $clase = new Conexion();
        $conexion = $clase->getConexion();
        $resultado = $conexion->query($consulta);
        $conexion = null;

        $familias = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $familias;
    }

    /**
     * Recibe como parámetro el código de una familia y devuelve un array 
     * con los códigos de todos los productos de esa familia.
     * 
     * @param string $codFamilia
     * @return array
     */
    public static function getProductosFamilia(string $codFamilia):array{

        $consulta = "SELECT * FROM productos WHERE familia = '" . $codFamilia . "'";

        $clase = new Conexion();
        $conexion = $clase->getConexion();
        $resultado = $conexion->query($consulta);
        $conexion = null;

        $productos = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $productos;

    }

}