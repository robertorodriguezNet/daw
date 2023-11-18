# lampp: https://www.youtube.com/watch?v=84y-qRFouK4
# phpmyadmin: https://youtu.be/AQxKGpWw2e8
# cod: https://pastecode.io/s/8dnqiu76
# 18/11/2023

apt update
apt upgrade -y
apt install apache2 -y
apt install php libapache2-mod-php php-mysql -y
systemctl restart apache2

# ¡OJO! comprobar usuario y grupo
chown -R roberto:roberto /var/www

chmod 2775 /var/www

# Permisos para los directorios después de /var/www
find /var/www -type d -exec chmod 2775 {} \;
find /var/www -type f -exec chmod 0664 {} \;

# Mandamos la información de PHP a phpinfo.php
echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php

apt install mariadb-server mariadb-client -y
systemctl status mariadb

mysql_secure_installation
# Switch to unix_socket authentication [Y/n] y
# You already have your root account protected, so you can safely answer 'n'.
# Change the root password? [Y/n] y
# New password: 0000
# Re-enter new password: 0000
# Remove anonymous users? [Y/n] y
# Disallow root login remotely? [Y/n] y
# Remove test database and access to it? [Y/n] y
# Reload privilege tables now? [Y/n] y

systemctl restart mariadb

# ----------------------------------------------
# -- PHPMYADMIN --------------------------------
# ----------------------------------------------

# Instalar dependencias
apt install php-mbstring php-xml -y
apt install php-fpm -y

systemctl restart apache2

# Descargar el archivo comprimido de phpMyAdmin en /var/www/html
# Copiar el enlace desde https://www.phpmyadmin.net/downloads/
wget -P /var/www/html https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.tar.gz 

mkdir /var/www/html/phpmyadmin 
tar -xvzf /var/www/html/phpMyAdmin-5.2.1-all-languages.tar.gz -C /var/www/html/phpmyadmin --strip-components 1

rm /var/www/html/phpMyAdmin-5.2.1-all-languages.tar.gz
systemctl restart mariadb
# systemctl status mariadb

