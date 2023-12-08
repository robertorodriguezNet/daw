#!/bin/bash

cd /opt

# Obtener el archivo comprimido
sudo wget https://github.com/wildfly/wildfly/releases/download/26.1.1.Final/wildfly-26.1.1.Final.tar.gz

sudo install default-jdk

# Crear grupo y usuario
sudo groupadd --system wildfly
sudo useradd -s /bin/login --system -d /opt/wildfly -g wildfly wildfly

# Descomprimir el archivo
sudo tar xzvf wildfly-26.1.1.Final.tar.gz

# Cambiar el nombre del directorio
mv wildfly-26.1.1.Final wildfly

# Copia de archivos administrativos
mkdir /etc/wildfly
sudo cp wildfly/docs/contrib/scripts/systemd/wildfly.conf /etc/wildfly
sudo cp wildfly/docs/contrib/scripts/systemd/wildfly.service /etc/systemd/system/
sudo cp wildfly/docs/contrib/scripts/systemd/launch.sh /opt/wildfly/bin

# Cambiar los permisos
sudo chmod +x wildfly/bin/launch.sh
sudo chown -R wildfly:wildfly wildfly/
sudo chmod -R +x wildfly/

sudo systemctl daemon-reload
sudo systemctl enable wildfly
sudo systemctl start wildfly

# Verificar que está escuchando en el puerto 8080 y 9990.
# El puerto 9990 es usado por la consola administrativa.
ss -tunelp | grep 8080
ss -tunelp | grep 9990

# ----------------------------------------------------------------
# Crear una cuenta de usuario administrativa.
# usuario/usuario
# Cuando pregunte si quiere vincular la cuenta a un grupo, lo dejamos en blanco.
# Las dos siguientes pregunatas: yes.

# Ejecutar el script
sudo wildfly/bin/add-user.sh

# Salida
# roberto@ubuntu-vb:/opt$ sudo wildfly/bin/add-user.sh

# What type of user do you wish to add? 
#  a) Management User (mgmt-users.properties) 
#  b) Application User (application-users.properties)
# (a): a

# Enter the details of the new user to add.
# Using realm 'ManagementRealm' as discovered from the existing property files.
# Username : usuario
# Password recommendations are listed below. To modify these restrictions edit the add-user.properties configuration file.
#  - The password should be different from the username
#  - The password should not be one of the following restricted values {root, admin, administrator}
#  - The password should contain at least 8 characters, 1 alphabetic character(s), 1 digit(s), 1 non-alphanumeric symbol(s)
# Password : 
# WFLYDM0098: The password should be different from the username
# Are you sure you want to use the password entered yes/no? yes
# Re-enter Password : 
# What groups do you want this user to belong to? (Please enter a comma separated list, or leave blank for none)[  ]: 
# About to add user 'usuario' for realm 'ManagementRealm'
# Is this correct yes/no? yes
# Added user 'usuario' to file '/opt/wildfly/standalone/configuration/mgmt-users.properties'
# Added user 'usuario' to file '/opt/wildfly/domain/configuration/mgmt-users.properties'
# Added user 'usuario' with groups  to file '/opt/wildfly/standalone/configuration/mgmt-groups.properties'
# Added user 'usuario' with groups  to file '/opt/wildfly/domain/configuration/mgmt-groups.properties'
# Is this new user going to be used for one AS process to connect to another AS process? 
# e.g. for a slave host controller connecting to the master or for a Remoting connection for server to server Jakarta Enterprise Beans calls.
# yes/no? yes
# To represent the user add the following to the server-identities definition <secret value="dXN1YXJpbw==" />


