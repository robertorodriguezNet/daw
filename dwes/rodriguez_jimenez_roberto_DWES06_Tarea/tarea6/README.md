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

## Conexión con la base de datos

El archivo encargado de crear la conexión con la base de datos es `src/Conexion.php`.\
Las clases que quieran hacer uso de la base de datos deberán heredarla.

El archivo `Conexion.php` debe declarar el uso de las clases **PDO** y **PDOException**.\
La conexión a la base de datos se debe cerrar desde el lugar en el que es creada, asignando null a la variable que contenga la conexión.

## Las clases

Cada una de las tablas de la base de datos se representa mediante una clase.\
Las clases heredan de `Conexion.php` para tener acceso a la base de datos.

## Operaciones.php - Las funciones 

# `getPVP`

Obtiene el precio de un producto dado por su *id*.\
En la función `getPVP` se recibe el *id* del producto y se crea una instancia de `Producto`.\
Mediante el método `setProducto($id)` se pide a la clase que establezca el estado del producto con los valores guardados en la base de datos.\
Finalmente, se duvuelve el valor de la propiedad `pvp`, previamente formateada para que aparezca con dos decimales.

```php
    public function getPVP($idProducto)
    {
        // Creamos un objeto Producto
        $producto = new Producto;
        $producto->setProducto($idProducto);

        // Formateamos el pvp con dos decimales
        $pvp = number_format($producto->getPvp(),2);

        return $pvp;
    }
```