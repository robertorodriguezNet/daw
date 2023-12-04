#!/bin/bash

apt update && apt upgrade -y
apt install openjdk-11-jdk
java -version