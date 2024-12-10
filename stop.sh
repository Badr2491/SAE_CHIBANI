#!/bin/bash

# Arrêter les services Docker
echo "Arrêt des services Docker..."
sudo docker-compose down

# Supprimer les conteneurs, les réseaux et les volumes associés
echo "Suppression des conteneurs, réseaux et volumes associés..."
sudo docker-compose down --volumes --remove-orphans

# Supprimer les images Docker créées
echo "Suppression des images Docker..."
sudo docker rmi $(sudo docker images -q)

# Nettoyer les volumes Docker non utilisés
echo "Suppression des volumes Docker non utilisés..."
sudo docker volume prune -f

# Nettoyer les réseaux Docker non utilisés
echo "Suppression des réseaux Docker non utilisés..."
sudo docker network prune -f

# Vérification de l'état des conteneurs Docker restants
echo "Vérification de l'état des conteneurs Docker restants..."
sudo docker ps -a

# Vérification de l'état des volumes Docker restants
echo "Vérification de l'état des volumes Docker restants..."
sudo docker volume ls

# Vérification de l'état des réseaux Docker restants
echo "Vérification de l'état des réseaux Docker restants..."
sudo docker network ls
