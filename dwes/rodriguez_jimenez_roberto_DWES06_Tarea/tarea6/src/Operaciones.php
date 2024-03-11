<?php
namespace Clases;

use Clases\Producto;
use Clases\Stock;
use Clases\Familia;

class Operaciones
{
    
    public function getPVP($idProducto):string
    {
        // Creamos un objeto Producto
        $producto = new Producto($idProducto);

        // Formateamos el pvp con dos decimales
        $pvp = number_format($producto->getPvp(),2);

        return $pvp;
    }

    public function getStock($idProducto, $idTienda):int
    {
        $stock = new Stock($idProducto, $idTienda);        
        return $stock->getUnidades();
    }

    public function getFamilias()
    {
        return Familia::getFamilias();
    }
    
    public function getProductoFamilia($codFamilia)
    {
        return Producto::getProductosFamilia($codFamilia);
    }
}