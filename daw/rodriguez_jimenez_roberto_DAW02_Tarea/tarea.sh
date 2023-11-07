#!/bin/bash

DOMINIO="empresa-tarea-daw02";

# Eliminar archivos, si los hubiera
rm /etc/apache2/sites-available/$DOMINIO.conf
rm /etc/apache2/sites-enabled/$DOMINIO.conf
rm -rd /var/www/todo-$DOMINIO

# Eliminar las líneas de hosts
sed '/empresa-tarea/d' -i /etc/hosts

clear

# 1.- Configurar un virtual host basado en el nombre denominado empresa-tarea-daw0s 
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
    </body>
</html>" >> /var/www/todo-${DOMINIO}/index.html

# Agregar el dominio al archivo hosts
cp /etc/hosts /etc/hosts_ORIGIN
sed '3 a 10.0.2.15 empresa-tarea-daw02' -i /etc/hosts
sed '4 a 10.0.2.15 www.empresa-tarea-daw02.local' -i /etc/hosts

# Resetear apache
systemctl restart apache2


# 2.- Hacer accesibles a través de internet las siguientes URL que identifican
# a la empresa: www.empresa-tarea-daw.local y empresa-tarea-daw-local

# Insertar el alias en el archivo de configuración
sed '/ServerAlias/d' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf
sed '/ServerName/ a     ServerAlias www.empresa-tarea-daw02.local empresa-tarea-daw02.local' -i /etc/apache2/sites-available/empresa-tarea-daw02.conf 

# Insertar el dominio en hosts
sed '/daw02.local/ a 10.0.2.15 empresa-tarea-daw02.local' -i /etc/hosts

systemctl restart apache2



# 3.- Configurar en el servidor el tipo MIME posible que permite la identificación
# correcta del vídeo de presentación formto flv situado dentro del directorio 
# videos y de nombre de entrada .flv. 

sed '/AddType application\/x-bzip2 .bz2/ a \\tAddType video/flv .flv' -i /etc/apache2/mods-available/mime.conf
sed '/AddType video\/flv .flv/ a \\tAddType video/x-flv .flv' -i /etc/apache2/mods-available/mime.conf

