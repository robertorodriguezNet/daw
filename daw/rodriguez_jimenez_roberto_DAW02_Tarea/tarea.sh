#!/bin/bash

DOMINIO="empresa-tarea-daw02";

# Eliminar archivos, si los hubiera
rm /etc/apache2/sites-available/$DOMINIO.conf
rm /etc/apache2/sites-enabled/$DOMINIO.conf
rm -rd /var/www/todo-$DOMINIO

# Eliminar las líneas de hosts
sed '/empresa-tarea/d' -i /etc/hosts

clear

# 1.- Configurar un virtual host basado en el nombre denominado empresa-tarea-daw02 
# que permita el acceso de la página web de la empresa en internet al directorio
# del servidor web: todo-empresa-tarea-daw02

# Crear el archivo de configuración empresa-tarea-daw02
echo -e "<VirtualHost *:80>
    ServerName ${DOMINIO}
    ServerAlias www.empresa-tarea-daw02.local
    DocumentRoot /var/www/todo-${DOMINIO}

    <Directory /var/www/todo-${DOMINIO}>
        DirectoryIndex index.html
    </Directory>
</VirtualHost>" >> /etc/apache2/sites-available/${DOMINIO}.conf

# Habilitar el sitio
a2ensite empresa-tarea-daw02.conf

# Comprobar que el servidor esté creado
# apachectl -S

# Crear index.html
mkdir /var/www/todo-${DOMINIO}
echo "<html>
    <head>
        <title>Empresa tarea DAW02</title>
    </head>
    <body>
        <h1>Empresa tarea DAW02</h1>
          <p>ACCESO NO LIMITADO</p>
    </body>
</html>" >> /var/www/todo-${DOMINIO}/index.html

# Agregar el dominio al archivo hosts
cp /etc/hosts /etc/hosts_ORIGIN
sed "3 a 10.0.2.15 ${DOMINIO}" -i /etc/hosts
sed "4 a 10.0.2.15 www.${DOMINIO}.local" -i /etc/hosts

# Resetear apache
systemctl restart apache2


# 2.- Hacer accesibles a través de internet las siguientes URL que identifican
# a la empresa: www.empresa-tarea-daw.local y empresa-tarea-daw-local

# Insertar el alias en el archivo de configuración
sed '/ServerAlias/d' -i /etc/apache2/sites-available/$DOMINIO.conf
sed '/ServerName/ a     ServerAlias www.empresa-tarea-daw02.local empresa-tarea-daw02.local' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf 

# Insertar el dominio en hosts
sed '/daw02.local/ a 10.0.2.15 empresa-tarea-daw02.local' -i /etc/hosts

systemctl restart apache2



# 3.- Configurar en el servidor el tipo MIME posible que permite la identificación
# correcta del vídeo de presentación formto flv situado dentro del directorio 
# videos y de nombre de entrada .flv. 

sed '/AddType application\/x-bzip2 .bz2/ a \\tAddType video/flv .flv' -i /etc/apache2/mods-available/mime.conf
sed '/AddType video\/flv .flv/ a \\tAddType video/x-flv .flv' -i /etc/apache2/mods-available/mime.conf

# 4.- Crear el subdirectorio todo-empresa-tarea-daw02/delimitado teniendo en cuenta que:
#   a. El directorio todo-empresa-tarea-daw02 permite el acceso a cualquier usuario.
#   b. El subdirectorio todo-empresa-tarea-daw02/delimitado permite el acceso solamente al personal de la empresa que tenga el rol:admin

# Crear el subdirectorio dentro de todo-empresa-tarea-daw02
mkdir /var/www/todo-$DOMINIO/delimitado

echo "<html>
    <head>
        <title>Empresa tarea DAW02</title>
    </head>
    <body>
        <h1>Empresa tarea DAW02</h1>
          <p>ACCESO LIMITADO</p>
    </body>
</html>" >> /var/www/todo-${DOMINIO}/delimitado/index.html

# Restringir el acceso a /delimitado mediante el archivo .htaccess
# - Crear un fichero para guardar las contraseñas en un lugar inaccesible desde la web
mkdir /etc/apache2/acceso

# Crear el archivo passwords con el usuario roberto (pass: 0000)
htpasswd -c /etc/apache2/acceso/passwords roberto

# Crear el archivo para especificar los grupos
echo "admin: roberto" > /etc/apache2/acceso/grupos

# Configurar el archivo .htacces en el directorio que se quiere proteger.
# Añadimos la directiva AllowOverride AuthConfig en la configuración del host.

# Crear una copia 
# cp /etc/apache2/sites-available/empresa-tarea-daw02.conf /etc/apache2/sites-available/empresa-tarea-daw02.conf_COPY

sed '/<\/Directory>/ a \
\
    <Directory \/var\/www\/todo-empresa-tarea-daw02\/delimitado>\
        AllowOverride AuthConfig\
    </Directory>\
    ' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf

# Crear el archivo .htaccess
echo "AuthType Basic
AuthName \"Area con autenticación\"
AuthBasicProvider file
AuthUserFile acceso/passwords
AuthGroupFile acceso/grupos
#Require valid-user
#Require group admin" >> /var/www/todo-$DOMINIO/delimitado/.htaccess

# Habilitar el módulo authz_groupfile para evitar problemas
a2enmod authz_groupfile
systemctl restart apache2



# 5 Permitir el protocolo HTTPS en el virtualhost empresa-tarea-daw02

# Crear el directorio en el que guardar los certificados
mkdir /etc/apache2/certs

# Generamos dos archivos:
# .- La clave privada con la que firmar los certificados: *.key
# .- El certificado con la clave pública de la AC: *.csr
# Este comando solicitará datos
openssl req -new -nodes -keyout /etc/apache2/certs/daw02.key -out /etc/apache2/certs/daw.csr

# Realizar la autofirma
openssl x509 -in /etc/apache2/certs/daw02.csr -out /etc/apache2/certs/daw02.crt -req -signkey /etc/apache2/certs/daw02.key -days 365

# Modificar el archivo de configuración
echo -e "<IfModule mod_ssl.c>
      <VirtualHost www.empresa-tarea-daw02.local:443>
                ServerAdmin webmaster@localhost

                DocumentRoot /var/www/todo-empresa-tarea-daw02

                SSLEngine on

                SSLCertificateFile      /etc/apache2/certs/daw02.crt
                SSLCertificateKeyFile  /etc/apache2/certs/daw02.key

                ErrorLog \${APACHE_LOG_DIR}/error.log
                CustomLog \${APACHE_LOG_DIR}/access.log combined

        </VirtualHost>
</IfModule>"  >> /etc/apache2/sites-available/$DOMINIO.conf

# Hbilitar el módulo ssl
a2enmod ssl
systemctl restart apache2

# 6.- Confifurar los archivos de registro como sigue:
# Mostrar el archivo log: tail -f nombre-archivo.log
sed '/DocumentRoot/ a \
    \
    LogFormat "%h %l %u \\"%r\\" %s> %O \\"%{User-Agent}i\\"" combined\
    CustomLog "empresa-tarea-daw02-access.log" combined\
    ErrorLog "empresa-tarea-daw02-error.log"\
' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf

# 7.- Rotar logs por intervalos de 24 horas.
sed '/ErrorLog "empresa-tarea-daw02-error.log"/ a \
    \
   CustomLog "|\/usr\/bin\/rotatelogs \/etc\/apache2\/empresa-tarea-daw02-access.log 86400" common\
    ErrorLog "|\/usr\/bin\/rotatelogs \/etc\/apache2\/empresa-tarea-daw02-error.log 86400"\
' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf

systemctl restart apache2