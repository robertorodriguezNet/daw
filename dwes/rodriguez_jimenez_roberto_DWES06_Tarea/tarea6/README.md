# DWES06 Tarea

## SERVICIOS WEB CON SOAP

## Enunciado

Se utilizará "PHP SOAP" para crear un servicio web con cuatro funciones que expongan información de la base de datos de la tienda online. 
En el primer servidor no deberás utilizaremos ningún archivo WSDL. Después generaremos uno y lo usaremos.

### Estructura de directorios y archivos

- **public**: donde crearemos los ficheros para llamar a los servicios que crearemos.
- **servidorSoap**: dondo generaremos nuestros servicios.
- **src**: directorio en el que guardar nuestras clases.
- **vendor**: la genera directamente *composer*.

![Estructura de la aplicación](/assets/DWES06_TAR_R01_Arbol.png "Estructura de la aplicación")

Crearemos el servidor SOAP *servicio.php* en la carpeta *servidorSoap*.
Este servicio no tendrá asociado ningún archivo **WSDL** y oferce los servicios:

- `getPvp`: Esta función recibirá como parámetro el código de un producto, y devolverá el PVP correspondiente al mismo.
- `getStock`:  Esta función recibirá dos parámetros: el código de un producto y el código de una tienda. Devolverá el **stock** existente en dicha tienda del producto.
- `getFamilias`: No recibe parámetros y devuelve un array con los códigos de todas las familias existentes.
- `getProductosFamilia`. Recibe como parámetro el código de una familia y devuelve un array con los códigos de todos los productos de esa familia.