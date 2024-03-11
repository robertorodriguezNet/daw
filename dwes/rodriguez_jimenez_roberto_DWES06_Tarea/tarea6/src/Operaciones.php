<?php
namespace Clases;

use Clases\Producto;
use Clases\Stock;

class Operaciones
{
    
    public function getPVP($idProducto)
    {
        // Creamos un objeto Producto
        $producto = new Producto($idProducto);

        // Formateamos el pvp con dos decimales
        $pvp = number_format($producto->getPvp(),2);

        return $pvp;
    }

    public function getStock($idProducto, $idTienda)
    {
        $stock = new Stock($idProducto, $idTienda);        
        return $stock->getUnidades();
    }

    public function getFamilias()
    {
        return "Familias";
    }
    
    public function getProductoFamilia($codFamilia)
    {
        return "Hola";
    }
}