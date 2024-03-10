# DWES06 Tarea

## SERVICIOS WEB CON SOAP

### Previo
- **SO**: Windows 10 sobre VirtualBox 7.0
- **Plataforma**: XAMPP
- **Versión de PHP**: 7.2.33
- **Editor**: Visual Studio Code
- **Composer**: 2.7.1

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


## GENERACIÓN DE LA ESTRUCTURA CON *COMPOSER*

Archivo `composer.json`.

```json
{
    "name": "roberto/tarea6",
    "description": "DWES06 Tarea",
    "type": "project",
    "license": "GPL",
    "autoload": {
        "psr-4": {
            "Clases\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Roberto Rodríguez",
            "email": "roberto.rodjim.1@educa.jcyl.es"
        }
    ],
    "minimum-stability": "dev",
    "require": {},
    "config": {
        "optimize-autoloader": true
    }
}
```

## Creación del servicio web

En el archivo `Operaciones.php` implementamos las funciones para cada servicio.