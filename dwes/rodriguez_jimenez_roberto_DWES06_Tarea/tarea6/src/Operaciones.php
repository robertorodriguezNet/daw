<?php
namespace Clases;

use Clases\Producto;
use Clases\Stock;
use Clases\Familia;

class Operaciones
{
    /**
     * Esta función recibirá como parámetro el código de un producto, y devolverá el PVP correspondiente al mismo.
     * 
     * @soap 
     * @param  int $idProducto
     * @return string 
     */
    public function getPVP(int $idProducto):string
    {
        // Creamos un objeto Producto
        $producto = new Producto($idProducto);

        // Formateamos el pvp con dos decimales
        $pvp = number_format($producto->getPvp(),2);

        return $pvp;
    }

    /**
     * Esta función recibirá dos parámetros: el código de un producto y el código de una tienda. Devolverá el stock existente en dicha tienda del producto.
     * 
     * @soap 
     * @param  int    $idProducto
     * @param  int    $idTienda
     * @return string
     */
    public function getStock($idProducto, $idTienda):int
    {
        $stock = new Stock($idProducto, $idTienda);        
        return $stock->getUnidades();
    }

    /**
     * Devuelve un array con los códigos de todas las familias existentes.
     * 
     * @soap 
     * @return string[]
     */
    public function getFamilias():array
    {
        return Familia::getFamilias();
    }
    
    /**
     * Devuelve un array con los códigos de todos los productos de esa familia.
     * 
     * @soap 
     * @param  string   $codFamilia
     * @return string[]
     */
    public function getProductoFamilia($codFamilia):array
    {
        return Producto::getProductosFamilia($codFamilia);
    }
}