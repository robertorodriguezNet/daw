
#!/bin/bash

# Indica dónde está Java (enlace simbólico)
which java

# También es un enlace simbólico
# Devuelve /etc/alternatives/java
ls -lha /usr/bin/java

# Devuelve la ruta: 
#/usr/lib/jvm/java-11-openjdk-amd64/bin/java
ls -lha /etc/alternatives/java

# Pegar en /etc/profile
# CATALINA_HOME=/opt/tomcat
# JAVA_HOME=/usr/lib/jvm/java-11-openjdk-amd64
# PATH=$PATH:$JAVA_HOME/bin:$CATALINA_HOME
# export PATH JAVA_HOME CATALINA_HOME

# Actualizar las variables de entorno
source /etc/profile