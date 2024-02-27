#!/bin/bash

DOMINIO="todo-empresa-tarea-daw04";

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
    ServerAlias www.${DOMINIO}.local
    DocumentRoot /var/www/${DOMINIO}

    <Directory /var/www/${DOMINIO}>
        DirectoryIndex index.html
    </Directory>
</VirtualHost>" >> /etc/apache2/sites-available/${DOMINIO}.conf

# Habilitar el sitio
a2ensite ${DOMINIO}.conf

# Comprobar que el servidor esté creado
# apachectl -S

# Crear index.html
mkdir /var/www/${DOMINIO}
echo "<html>
    <head>
        <title>Empresa tarea DAW04</title>
    </head>
    <body>
        <h1>Empresa tarea DAW04</h1>
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