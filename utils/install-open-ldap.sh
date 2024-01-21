#! /bin/bash

# Instalación de OpenLDAP en Ubuntu 20
# http://www.ite.educacion.es/formacion/materiales/85/cd/linux/m6/instalacin_y_configuracin_de_openldap.html

clear

# Instalación del servidor LDAP y el paquete de utilidades.
# Pedirá contraseña para el administrador
apt-get install slapd ldap-utils -y