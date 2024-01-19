#! /bib/bash

# Instala el servidro LAMP mediante taskel.
# Taskel permite la instalación de paquetes de aplicaciones con un solo comando.
# Entre las tareas que incluye taskel se encuentra lamp-server


# Pasos:
# 1.- Instalar taskel
# 2.- Instalar lamp-server
# 3.- Habilitar el módulo userdir de Apache para poder trabajar en nuestro directorio y no tener problemas de permisos.
# 4.- Crear la carpeta public_html
# 5.- Confirugrar Apache para poder ejecutar php en la carpeta public_html
# 6.- Comprobar que todo lo anterior ha funcionado.

clear

# Instalación del taskel
apt install taskel