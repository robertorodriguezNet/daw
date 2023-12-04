#!/bin/bash

apt update && apt upgrade -y
apt install openjdk11-11-jdk
java -version