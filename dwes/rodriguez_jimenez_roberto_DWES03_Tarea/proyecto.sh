# Ejercicio 2.2.1
# Estructura
mysql -u root < /home/roberto/Documentos/daw/dwes/rodriguez_jimenez_roberto_DWES03_Tarea/proyecto.sql;

# Ejercicio 2.2.2
# Cargar datos
mysql -u root < /home/roberto/Documentos/daw/dwes/rodriguez_jimenez_roberto_DWES03_Tarea/proyecto_datos.sql;

# Ejercicio 3.1.3
# Mover una unidad del producto 3DSNG de la tienda 1 a la 3
# usando transacciones.

# Para el ejercicio vamos a crear la web 'proyecto'
mkdir "/var/www/proyecto";

echo "<?php 
    // Ejercicio 3.1.3
?>" > /var/www/proyecto/ejercicio-3-1-3.php

chown roberto:roberto -R proyecto

# Permisos para los directorios después de /var/www
find /var/www/proyecto -type d -exec chmod 2775 {} \;
find /var/www/proyecto -type f -exec chmod 0664 {} \;