#!/bin/bash

clear

rm -rf /var/ftp

# Actualizar repositorios
apt-get update

# Actualizar SO
apt-get upgrade

# Crear el directorio para todo-empresa-tarea-daw04
mkdir /var/ftp
mkdir /var/ftp/todo-empresa-tarea-daw04

# Crear algunos archivod
touch /var/ftp/todo-empresa-tarea-daw04/index.html
touch /var/ftp/todo-empresa-tarea-daw04/texto.txt

# Propietario y permisos
chown ftp /var/ftp/todo-empresa-tarea-daw04
chmod 766 -R /var/ftp/todo-empresa-tarea-daw04

# Directorio para el usuario user-empresa
mkdir /var/ftp/empresa
chown ftp /var/ftp/empresa
chmod 766 -R /var/ftp/empresa


# --- ProFTPD -----------------------------
# Buscar el paquete ProFTPD
apt-get search proftpd

# Instalar proftpd
apt-get install proftpd

# Directorio de configuración de ProFTPD
ls -l /etc/proftpd

# Comprobar el estado del servicio
systemctl status proftpd

# Crear un usuario virtual
ftpasswd --passwd --name user-empresa /etc/passwd.usuarios.virtuales --uid 129 --home /var/ftp/empresa --shell /bin/false 

# Modificar el archivo de configuración proftpd.conf para descomentar el archivo tls.conf
TEMPORAL=`mktemp`
cat /etc/proftpd/proftpd.conf | sed "s/\#Include \/etc\/proftpd\/tls.conf/Include \/etc\/proftpd\/tls.conf/g" > $TEMPORAL
mv $TEMPORAL /etc/proftpd/proftpd.conf

# Modificar el archivo de configuración proftpd.conf para descomentar el archivo virtuals.conf
TEMPORAL_VIRTUAL=`mktemp`
cat /etc/proftpd/proftpd.conf | sed "s/\#Include \/etc\/proftpd\/virtuals.conf/Include \/etc\/proftpd\/virtuals.conf/g" > $TEMPORAL_VIRTUAL
mv $TEMPORAL_VIRTUAL /etc/proftpd/proftpd.conf


# Modificar el archivo tls.conf para que tenga el contenido
cat > /etc/proftpd/tls.conf << EOF
##########################################Fichero /etc/proftpd/tls.conf###############################################
<IfModule mod_tls.c>
<global>
TLSEngine                               on
TLSLog                                  /var/log/proftpd/tls.log
</global>

TLSProtocol                             SSLv23

<global>
MENORglobalMAYOR
TLSRSACertificateFile                   /etc/ssl/certs/proftpd.crt
TLSRSACertificateKeyFile                /etc/ssl/private/proftpd.key
TLSOptions                              NoCertRequest
TLSVerifyClient                         off
TLSRequired                             on
TLSRenegotiate                          required off
</global>

</IfModule>
###########################################Fin /etc/proftpd/tls.conf###############################################
EOF

# Modificar el archivo virtuals.conf
cat > /etc/proftpd/virtuals.conf << EOF
<VirtualHost 10.0.2.15>
    ServerName "Servidor FTP de empresa tarea"
    DefaultRoot /var/ftp/todo-empresa-tarea-daw04
    RequireValidShell off
    AuthUserFile /etc/passwd.usuarios.virtuales
</VirtualHost>
EOF

# Generar el certificado
proftpd-gencert

systemctl restart proftpd

# Desinstalar proftpd
#apt-get remove proftpd-basic

# --- FILEZILLA -----------------------------
# Buscar el paquete filezilla
apt-cache search filezilla

# Instalar filezilla
apt-get install filezilla

# Arrancar filezilla con un usuario del sistema
su -c filezilla roberto