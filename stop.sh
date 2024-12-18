#!/bin/bash

# Arrêter et supprimer les conteneurs Docker
echo "Arrêt des conteneurs Docker..."
sudo docker-compose down

# Supprimer les volumes Docker
echo "Suppression des volumes Docker..."
sudo docker volume prune -f

# Supprimer les images Docker utilisées
echo "Suppression des images Docker..."
sudo docker rmi -f $(sudo docker images -q)

# Supprimer le répertoire de l'application
echo "Suppression du répertoire de l'application..."
rm -rf ~/myapp

# Désinstaller Docker Compose
echo "Désinstallation de Docker Compose..."
sudo apt remove --purge docker-compose -y

# Désinstaller Docker
echo "Désinstallation de Docker..."
sudo apt remove --purge docker-ce docker-ce-cli containerd.io -y
sudo apt autoremove -y

# Supprimer les fichiers de dépôt Docker
echo "Suppression des fichiers de dépôt Docker..."
sudo rm /etc/apt/sources.list.d/docker.list

# Supprimer la clé GPG de Docker
echo "Suppression de la clé GPG de Docker..."
sudo rm /usr/share/keyrings/docker-archive-keyring.gpg

# Nettoyer le cache APT
echo "Nettoyage du cache APT..."
sudo apt clean

# Supprimer le répertoire des volumes Docker
echo "Suppression du répertoire des volumes Docker..."
sudo rm -rf /var/lib/docker

# Vérifier les services Docker restant
echo "Vérification des services Docker restant..."
sudo docker ps -a

# Vérification si Docker est complètement désinstallé
echo "Vérification de l'installation de Docker..."
if ! command -v docker &> /dev/null
then
    echo "Docker a été supprimé avec succès."
else
    echo "Docker n'a pas été complètement supprimé."
fi
