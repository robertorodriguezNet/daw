#!/bin/bash

# Ver:
# 

# comprobar la disponibilidad de tomcat
# apt-cahe search tomcat

apt update && apt upgrade -y
apt install openjdk-11-jdk
apt install tomcat9 tomcat9-admin -y

# Comprobar los puertos
# Debe aparecer *:8080 para tomcat
# ss -ltn

# Añadir el puerto al firewall
ufw allow from any to any port 8080 proto tcp

# Acceso a tomcat
# http://127.0.0.1:8080/

