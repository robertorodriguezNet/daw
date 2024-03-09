<?php 
/**
 * Script que genera el documento WSDL.
 * 
 * Una vez revisado el documento generado, se ha de copiar a un directorio
 * accesible desde la web.
 * 
 * Hay que referenciar el archivo desde el la clase SoapServer. 
 * $server = new SoapServer("http://localhost/unidad6/servidorSoap/servicio.wsdl");
 */

 require "../vendor/autoload.php";

 use PHP2WSDL\PHPClass2WSDL;

 // Clase que gestiona el servicio
 $class = "Clases\\Operaciones";

 // URI que ofrece el servicio
 $uri = 'http://localhost/unidad6/serverSoap/server.php';

 // Crear el generador del wsdl
 $wsdlGenerator = new PHPClass2WSDL($class, $uri);

 // El parámetro true indica que solo convierta los métodos 
 // públicos con el parámetro @soap
 $wsdlGenerator->generateWSDL(true);

 // Apache debe tener perimso de escritura
 $ficher = $wsdlGenerator->save('../servidorSoap/service.wsdl');