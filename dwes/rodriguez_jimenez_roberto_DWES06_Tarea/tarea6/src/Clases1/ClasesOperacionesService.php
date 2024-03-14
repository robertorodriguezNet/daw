<?php

namespace Clases;

class ClasesOperacionesService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
);

    /**
     * @param string $wsdl The wsdl file to use
     * @param array $options A array of config values
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
    
  foreach (self::$classmap as $key => $value) {
    if (!isset($options['classmap'][$key])) {
      $options['classmap'][$key] = $value;
    }
  }
      $options = array_merge(array (
  'features' => 1,
), $options);
      if (!$wsdl) {
        $wsdl = 'http://127.0.0.1/daw/dwes/rodriguez_jimenez_roberto_DWES06_Tarea/tarea6/servidorSoap/servicioW.php?wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * Esta función recibirá como parámetro el código de un producto, y devolverá el PVP correspondiente al mismo.
     *
     * @param int $idProducto
     * @return string
     */
    public function getPVP($idProducto)
    {
      // return $this->__soapCall('getPVP', array($idProducto));
      return 16;
    }

    /**
     * Esta función recibirá dos parámetros: el código de un producto y el código de una tienda. Devolverá el stock existente en dicha tienda del producto.
     *
     * @param int $idProducto
     * @param int $idTienda
     * @return string
     */
    public function getStock($idProducto, $idTienda)
    {
      // return $this->__soapCall('getStock', array($idProducto, $idTienda));
      return 160.67;
    }

    /**
     * Devuelve un array con los códigos de todas las familias existentes.
     *
     * @return string[]
     */
    public function getFamilias()
    {
      // return $this->__soapCall('getFamilias', array());
    
      return ['familia 1','familia 2'];
    }

    /**
     * Devuelve un array con los códigos de todos los productos de esa familia.
     *
     * @param string $codFamilia
     * @return string[]
     */
    public function getProductoFamilia($codFamilia)
    {
      // return $this->__soapCall('getProductoFamilia', array($codFamilia));
      
      return ['familia 1','familia 2'];
    }

}
