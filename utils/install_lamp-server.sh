#! /bib/bash

# Instala el servidro LAMP mediante taskel.
# Taskel permite la instalación de paquetes de aplicaciones con un solo comando.
# Entre las tareas que incluye taskel se encuentra lamp-server


# Pasos:
# 1.- Instalar tasksel
# 2.- Instalar lamp-server
# 3.- Habilitar el módulo userdir de Apache para poder trabajar en nuestro directorio y no tener problemas de permisos.
# 4.- Crear la carpeta public_html
# 5.- Confirugrar Apache para poder ejecutar php en la carpeta public_html
# 6.- Comprobar que todo lo anterior ha funcionado.

clear

# Instalación del tasksel
sudo apt install tasksel -y

# Instalación de lamp-server mediante taksel.
# Se abre modo gráfico
sudo tasksel install lamp-server

# Habilitar el módulo userdir de Apache.
# Cambiamos el directorio por defecto de Apache (/var/www) por el directorio del usuario y así evitar problemas con los permisos.
sudo a2enmod userdir
mkdir ~/public_html
sudo systemctl restart apache

# Editar el archivo php*.conf para permitir la ejecución de PHP en html_public
# En esta instalación se ha instalado php7.4.
# Hay que comentar el bloque <IfModule mod_userdir.c>
sudo vim /etc/apache2/mods-enabled/php7.4.cofn


# Crear el archivo info.php en pubic.html
echo "<?php phpinfo(); ?>" >> ~/public_html/info.php

# Reiniciar apache