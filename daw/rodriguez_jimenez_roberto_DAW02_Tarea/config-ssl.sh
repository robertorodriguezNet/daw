#!/bin/bash

LINEA="---------------------------------"
ORANGE='\033[0;33m'
NOCOLOR='\033[0m'
DOMINIO='empresa-tarea-daw02'


clear

printf "\n${ORANGE}Directorios ${NOCOLOR}"
echo -e "\n/var/www"
ls -l /var/www
echo -e "\n/etc/apache2/sites-available/"
ls -l /etc/apache2/sites-available/
echo -e "\n/etc/apache2/sites-enabled"
ls -l /etc/apache2/sites-enabled/

printf "\n${LINEA}\n${ORANGE}Archivo hosts${NOCOLOR}\n"
cat /etc/hosts

printf "\n${LINEA}\n${ORANGE}Instalar OpenSSL${NOCOLOR}\n"
apt-get install openssl

printf "\n${ORANGE}Habilitar SSL${NOCOLOR}\n"
a2enmod ssl

# Modificar el archivo de configuración
# Restaurar el archivo de configuración antes de re-escribirlo
cp /etc/apache2/sites-available/$DOMINIO-SECURE.conf /etc/apache2/sites-available/$DOMINIO.conf

printf "\n${LINEA}\n${ORANGE}Modificar el archivo /etc/apache2/sites-available/${DOMINIO}.conf${NOCOLOR}\n"

echo -e "<IfModule mod_ssl.c>
        <VirtualHost www.${DOMINIO}.local:443>
                ServerAdmin webmaster@localhost

                DocumentRoot /var/www/todo-empresa-tarea-daw02

                ErrorLog \${APACHE_LOG_DIR}/error.log
                CustomLog \${APACHE_LOG_DIR}/access.log combined

                SSLEngine on

                SSLCertificateFile      /etc/ssl/certs/ssl-cert-snakeoil.pem
                SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key

                <FilesMatch \"\.(cgi|shtml|phtml|php)$\">
                                SSLOptions +StdEnvVars
                </FilesMatch>
                <Directory /usr/lib/cgi-bin>
                                SSLOptions +StdEnvVars
                </Directory>



        </VirtualHost>
</IfModule>"  >> /etc/apache2/sites-available/$DOMINIO.conf

cat /etc/apache2/sites-available/$DOMINIO.conf

# Resetear Apache para porbar
printf "\n${ORANGE}Reseterar apache${NOCOLOR}\n
systemctl restart apache2"

