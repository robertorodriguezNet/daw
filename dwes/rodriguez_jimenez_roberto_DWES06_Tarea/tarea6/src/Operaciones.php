<?php
namespace Clases;

use Clases\Producto;

class Operaciones
{
    
    public function getPVP($idProducto)
    {
        // Creamos un objeto Producto
        $producto = new Producto;
        $producto->setProducto($idProducto);

        // Formateamos el pvp con dos decimales
        $pvp = number_format($producto->getPvp(),2);

        return $pvp;
    }

    public function getStock($codProducto, $codTienda)
    {
        return 210;
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