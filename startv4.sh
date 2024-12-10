#!/bin/bash

# Mise à jour du système
echo "Mise à jour du système..."
sudo apt update && sudo apt upgrade -y

# Installation des dépendances pour Docker
echo "Installation des dépendances Docker..."
sudo apt install apt-transport-https ca-certificates curl software-properties-common -y

# Ajouter la clé GPG de Docker
echo "Ajout de la clé GPG Docker..."
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Ajouter le dépôt Docker
echo "Ajout du dépôt Docker..."
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Installation de Docker
echo "Installation de Docker..."
sudo apt update
sudo apt install docker-ce docker-ce-cli containerd.io -y

# Vérification de l'installation de Docker
echo "Vérification de l'installation de Docker..."
sudo docker --version

# Lancer Docker au démarrage
echo "Lancement de Docker..."
sudo systemctl enable docker
sudo systemctl start docker

# Installation de Docker Compose
echo "Installation de Docker Compose..."
sudo apt install docker-compose -y

# Créer le répertoire de l'application
echo "Création du répertoire de l'application..."
mkdir -p ~/myapp

# Créer le fichier docker-compose.yml pour MySQL, phpMyAdmin, PHP et LDAP
echo "Création du fichier docker-compose.yml..."
cat <<EOL > ~/myapp/docker-compose.yml
version: '3.8'

services:
  backend:
    build:
      context: .
      dockerfile: backend/Dockerfile  # Utilise le Dockerfile personnalisé pour le backend
    container_name: backend
    volumes:
      - ./backend:/var/www/html
    ports:
      - "8080:80"
    networks:
      - mynetwork

  mysql:
    image: mysql:5.7
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: userdb
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - mynetwork
    ports:
      - "3306:3306"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
      MYSQL_ROOT_PASSWORD: rootpassword
    ports:
      - "8081:80"
    networks:
      - mynetwork

  ldap:
    image: osixia/openldap:1.5.0
    container_name: ldap
    environment:
      LDAP_ORGANISATION: "MyOrg"
      LDAP_DOMAIN: "myorg.local"
      LDAP_ADMIN_PASSWORD: adminpassword
    ports:
      - "389:389"
      - "636:636"
    networks:
      - mynetwork

volumes:
  mysql_data:

networks:
  mynetwork:
    driver: bridge
EOL

# Créer le répertoire backend et ajouter le fichier PHP de test
echo "Création du répertoire backend et ajout du fichier PHP de test..."
mkdir -p ~/myapp/backend
cat <<EOL > ~/myapp/backend/index.php
<?php
// Connexion à MySQL
\$mysqli = new mysqli("mysql", "root", "rootpassword", "userdb");

if (\$mysqli->connect_error) {
    die("Échec de la connexion MySQL : " . \$mysqli->connect_error);
}
echo "Connexion MySQL réussie.<br>";

// Connexion à LDAP
\$ldapconn = ldap_connect("ldap://ldap") or die("Impossible de se connecter à LDAP");

if (\$ldapconn) {
    echo "Connexion LDAP réussie.<br>";
    ldap_close(\$ldapconn);
}
?>
EOL

# Créer le Dockerfile pour le backend
echo "Création du fichier Dockerfile pour le backend..."
mkdir -p ~/myapp/backend
cat <<EOL > ~/myapp/backend/Dockerfile
# Utiliser l'image php:7.4-apache de base
FROM php:7.4-apache

# Installer les dépendances nécessaires pour MySQLi
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activer l'extension MySQLi
RUN docker-php-ext-enable mysqli

# Exposer le port 80
EXPOSE 80
EOL

# Naviguer dans le répertoire de l'application
cd ~/myapp

# Démarrer les services Docker avec Docker Compose
echo "Démarrage des services Docker..."
sudo docker-compose up -d

# Afficher les services en cours d'exécution
echo "Les services suivants sont en cours d'exécution :"
sudo docker-compose ps

# Afficher l'URL pour accéder à phpMyAdmin
echo "Vous pouvez accéder à phpMyAdmin via l'URL suivante : http://localhost:8081"

# Afficher l'URL pour accéder à votre backend PHP
echo "Vous pouvez accéder à votre application PHP via l'URL suivante : http://localhost:8080"
