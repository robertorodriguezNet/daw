#!/bin/bash

clear

# dpkg --list|grep -e httpd -e apache -e mysql -e php

# # Comprobar si algún proceso en ejecución
# ps -wef|grep apache2

# Apache ------------------------
apt-get install apache2

# MySQL -------------------------
apt-get install mysql-server

# Se inicia el proceso
echo "Nivel para pass: 0"
echo "Borrar usuario anónimo: y"
echo "Deshabilitar login remoto: y"
echo "Norrar test database: n"
echo "Recargar privilegios: s"

mysql_secure_installation

# PHP 8.1 ------------------------
apt-get install software-properties-common
add-apt-repository ppa:ondrej/php
appt-get update
apt install php8.1 libapache2-mod-php8.1 php8.1-cli php8.1-mysql php8.1-gd php8.1-imagick php*-recode php8.1-tidy php8.1-xmlrpc

clear

apache2 -v
mysql --version
php -v

# Estos comando se deben ejecutar manualmente, pues son de MySQL
# alter user 'root'@'localhost' identified with auth_socket by '12345678';
# alter user 'root'@'localhost' identified with mysql_native_password by '12345678';
# select user, authentication_string, plugin, host from mysql.user;

# Hay que volver a entrar como root con la clave
# sudo mysql -u root -p

# create user 'roberto'@'localhost' identified by '12345678';
# grant all privileges on *.* to 'roberto'@'localhost' with grant option;