#!/bin/bash

# Configuración para Ubuntu 22 limpio

apt update && apt -y upgrade

apt install -y git
apt install snap
apt install curl
snap install --classic code
apt install -y default-jdk
apt install vim