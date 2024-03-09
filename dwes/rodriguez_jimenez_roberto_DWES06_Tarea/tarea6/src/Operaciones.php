<?php
namespace Clases;

/**
 * @method float    getPVP(string $codigoProducto)
 * @method int      getStock(string $codigoProducto, string $codigoTienda)
 * @method string[] getFamilias()
 * @method string[] getProductosFamilia(string $codigoFamilia)
 */
class Operaciones
{
    /**
     * Devuelve el PVP correspondiente al mismo.
     * Recibe como parámetro el código de un producto
     * 
     * @soap
     * @param  string $codigoProducto el código del producto.
     * @return float
     */
    public function getPVP(string $codigoProducto):float{
        return 0;
    }

    /**
     * Devuelve el stock existente en dicha tienda del producto.
     * Recibe dos parámetros: el código de un producto y el código de una tienda.
     * 
     * @soap
     * @param  string $codigoProducto el código del producto.
     * @param  string $codigoTienda   el código de la tienda.
     * @return float
     */
    public function getStock(string $codigoProducto, string $codigoTienda):int{
        return 0;
    }

    /**
     * Devuelve un array con los códigos de todas las familias existentes.
     * No recibe parámetros.
     * 
     * @soap
     * @return string[]
     */
    public function getFamilias(): array{
        return [];
    }

    /**
     * Devuelve un array con los códigos de todos los productos de esa familia.
     * Recibe como parámetro el código de una familia.
     * 
     * @soap     
     * @param  string    $codigoFamilia  el código de la familia.
     * @return string[]
     */
    public function getProductosFamilia(string $codigoFamilia):array{
        return [];
    }
}