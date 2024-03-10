<?php
namespace Clases;

class Operaciones
{
    public function getPVP($idProducto)
    {
        return 79.99;
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