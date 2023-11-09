#!/bin/bash

clear

# # Instalamos el módulo OpenSSL y lo habilitamos
# apt install openssl
# a2enmod ssl
# systemctl restart apache2

# # Crear el directorio para albergar los certificados propios
# mkdir /etc/apache2/ssl

# # Crear la clave privada del servidor usando OpenSSL
# # Frase: frase para ssl
# openssl genrsa -des3 -out /etc/apache2/ssl/server.key 1024

# # Generar el archivo pem (pide la frase)
# openssl rsa -in /etc/apache2/ssl/server.key -out /etc/apache2/ssl/server.pem

# # Generar el archivo csr
# openssl req -new -key /etc/apache2/ssl/server.key -out /etc/apache2/ssl/server.csr

# # Datos introducidos
# # ----------------------
# # Country Name (2 letter code) [AU]:ES
# # State or Province Name (full name) [Some-State]:Salamanca
# # Locality Name (eg, city) []:
# # Organization Name (eg, company) [Internet Widgits Pty Ltd]:DAW
# # Organizational Unit Name (eg, section) []:DAW
# # Common Name (e.g. server FQDN or YOUR name) []:www.empresa-tarea-daw02.local
# # Email Address []:webmaster@empresa-tarea-daw02.local

# # Please enter the following 'extra' attributes
# # to be sent with your certificate request
# # A challenge password []:
# # An optional company name []:

# # En este momento ya estamos autorizados para firmar certificados

# # Generar nuestro certificado autofirmado
# openssl x509 -req -days 365 -in /etc/apache2/ssl/server.csr -signkey /etc/apache2/ssl/server.key -out /etc/apache2/ssl/servert.crt

# # Daos de salida:
# # -------------------------
# # Certificate request self-signature ok
# # subject=C = ES, ST = Salamanca, O = DAW, OU = DAW, CN = www.empresa-tarea-daw02.local, emailAddress = webmaster@empresa-tarea-daw02.local

# # Ahora ya tenemos todos los certificados

# # Hay que crear un host virtual que contendrá el certificado
# mkdir /var/www/autofirmado.ssl.empresa-tarea-daw02
# echo "Autofirmado" > /var/www/autofirmado.ssl.empresa-tarea-daw02/index.html

# # Crear el archivo de configuración para autofirmado.ssl.empresa-tarea-daw02
# echo -e "<VirtualHost *:443>
#     ServerName empresa-tarea-daw02
#     ServerAlias www.empresa-tarea-daw02.local empresa-tarea-daw02.local
#     DocumentRoot /var/www/autofirmado.ssl.empresa-tarea-daw02

#     SSLEngine on
#     SSLCertificateFile	/etc/apache2/ssl/server.pem
#     SSLCertificateKeyFile /etc/apache2/ssl/server.pem      
    
# </VirtualHost>" > /etc/apache2/sites-available/autofirmado.ssl.empresa-tarea-daw02.conf

# systemctl restart apache2