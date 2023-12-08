#!/bin/bash

# Instalación de Apache Ant.
# Ejecutamos como súper usuario.
apt-get update && apt-get -y upgrade

# Descargamos en /tmp
cd /tmp
wget https://dlcdn.apache.org//ant/binaries/apache-ant-1.9.16-bin.tar.gz

# Descomprimir el archivo
tar xzvf apache-ant-1.9.16-bin.tar.gz

# Mover el directorio a /usr/local
mv apache-ant-1.9.16 /usr/local

# Crear la variable ANT_HOME para indicar el directorio raíz de Ant
# PATH define la ruta de acceo para los binarios del sistema.

# Agregar a /etc/profile las variables
echo "ANT_HOME=/usr/local/apache-ant-1.9.16" >> /etc/profile
echo "PATH=\$PATH:\$ANT_HOME/bin" >> /etc/profile

# Actualizar los cambios.
source /etc/profile

# Probar que está correctamente instalado:
# ant

# Salida:
# Buildfile: build.xml does not exist!
# Build failed
