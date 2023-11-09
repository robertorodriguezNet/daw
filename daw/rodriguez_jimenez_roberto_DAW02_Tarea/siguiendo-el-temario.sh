#!/bin/bash

# # Borrar directorios si existirean
# rm -rd /var/www/autofirmado.ssl.todo-empresa-tarea-daw02
# rm /etc/apache2/sites-available/autofirmado.ssl.empresa-tarea-daw02.conf
# rm -rd /etc/apache2/certs
# sed '/10.0.2.15 autofirmado.ssl.empresa-tarea-daw02.local/d ' -i /etc/hosts
# sed 's/apache2\/certs\/apache.pem/ssl\/certs\/ssl-cert-snakeoil.pem/' -i /etc/apache2/sites-available/default-ssl.conf
# sed 's/apache2\/certs\/apache.pem/ssl\/private\/ssl-cert-snakeoil.key/' -i /etc/apache2/sites-available/default-ssl.conf

clear

# Instalar OpenSSL
apt install openssl

# Crear los directorios para los certificados propios
mkdir /etc/apache2/certs


# Generar el certificado autofirmado para el servidor
make-ssl-cert /usr/share/ssl-cert/ssleay.cnf /etc/apache2/certs/apache.pem

# Modificar deafult-ssl
sed 's/ssl\/certs\/ssl-cert-snakeoil.pem/apache2\/certs\/apache.pem/' -i /etc/apache2/sites-available/default-ssl.conf
sed 's/ssl\/private\/ssl-cert-snakeoil.key/apache2\/certs\/apache.pem/' -i /etc/apache2/sites-available/default-ssl.conf

# Insertar la el dominio en hosts
sed '/The following lines are desirable for IPv6 capable hosts/ i \
\
10.0.2.15 autofirmado.ssl.empresa-tarea-daw02.local\
\
    ' -i /etc/hosts

# Crear el hostVirtual autofirmado
mkdir /var/www/autofirmado.ssl.todo-empresa-tarea-daw02
echo "<html>
    <head>
        <title>Empresa tarea DAW02</title>
    </head>
    <body>
        <h1>Empresa tarea DAW02</h1>
        <h2>autofirmado</h2>
          <p>Acceso seguro mediante ssl</p>
    </body>
</html>" >> /var/www/autofirmado.ssl.todo-empresa-tarea-daw02/index.html

# Archivo de configuración
echo -e "<VirtualHost *:80>
    ServerName empresa-tarea-daw02
    ServerAlias www.empresa-tarea-daw02.local empresa-tarea-daw02.local autofirmado.ssl.empresa-tarea-daw02
    DocumentRoot /var/www/autofirmado.ssl.empresa-tarea-daw02 
    
</VirtualHost>" > /etc/apache2/sites-available/autofirmado.ssl.empresa-tarea-daw02.conf

a2enmod ssl
a2ensite default-ssl
systemctl restart apache2