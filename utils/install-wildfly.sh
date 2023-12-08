#!/bin/bash

cd /opt

# Obtener el archivo comprimido
sudo wget https://github.com/wildfly/wildfly/releases/download/26.1.1.Final/wildfly-preview-26.1.1.Final.tar.gz

sudo install default-jdk

# Crear grupo y usuario
sudo groupadd --system wildfly
sudo useradd -s /bin/login --system -d /opt/wildfly -g wildfly wildfly

# Descomprimir el archivo
sudo tar xzvf wildfly-26.1.3.Final.tar.gz

# Cambiar el nombre del directorio
mv wildfly-26.1.3.Final wildfly

# Copia de archivos administrativos
mkdir /etc/wildfly
sudo cp wildfly/docs/contrib/scripts/systemd/wildfly.conf /etc/wildfly
sudo cp wildfly/docs/contrib/scripts/systemd/wildfly.service /etc/systemd/system/
sudo cp wildfly/docs/contrib/scripts/systemd/launch.sh /etc/wildfly/bin

# Cambiar los permisos
sudo chmod +x wildfly/bin/launch.sh
sudo chmod -R wildfly:wildfly wildfly/
sudo chmod -R +x wildfly/

sudo systemctl daemon-reload
sudo systemctl enable wildfly
sudo systemctl start wildfly

ss -tunelp | grep 8080
ss -tunelp | grep 9990