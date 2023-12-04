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