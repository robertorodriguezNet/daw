#!/bin/bash

apt install openjdk-11-jdk
cd /tmp
curl -O https://dlcdn.apache.org/tomcat/tomcat-9/v9.0.83/bin/apache-tomcat-9.0.83.tar.gz
mkdir /opt/tomcat
tar xzvf apache-tomcat-9.0.80.tar.gz -C /opt/tomcat --strip-components=1

cd /opt/tomcat
chgrp -R tomcat /opt/tomcat
chmod -R g+r conf
chmod g+x conf
chown -R tomcat webapps/ work/ tem/ logs/


# [Unit]
# Description=Apache Tomcat Web Application Container
# After=network.target

# [Service]
# Type=forking

# Environment=JAVA_HOME=/usr/lib/jvm/java-1.11.0-openjdk-amd64
# Environment=CATALINA_PID=/opt/tomcat/temp/tomcat.pid
# Environment=CATALINA_HOME=/opt/tomcat
# Environment=CATALINA_BASE=/opt/tomcat
# Environment='CATALINA_OPTS=-Xms512M -Xmx1024M -server -XX:+UseParallelGC'
# Environment='JAVA_OPTS=-Djava.awt.headless=true -Djava.security.egd=file:/dev/./urandom'

# ExecStart=/opt/tomcat/bin/startup.sh
# ExecStop=/opt/tomcat/bin/shutdown.sh

# User=tomcat
# Group=tomcat
# UMask=0007
# RestartSec=10
# Restart=always

# [Install]
# WantedBy=multi-user.target