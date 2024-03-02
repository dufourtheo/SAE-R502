#!/bin/bash

# How to use
#----------------------------------------------------#
if [ $# -eq 0 ]; then
    echo "Usage: $0 <nom_image_docker>" #<--- la commande qui est renvoye est . --> ./lancementcontainer.sh <nom-container> & | le "&" pour que le script tourne en fond
    exit 1
fi
#----------------------------------------------------#
# Générer un nom de conteneur
CONTAINER_NAME="container_$(date +%s)"
# Vérifie si le conteneur existe déjà
if docker inspect $CONTAINER_NAME >/dev/null 2>&1; then
    # Récupérer le port externe déjà exposé pour le conteneur
    EXPOSED_PORT=$(docker inspect --format='{{(index (index .NetworkSettings.Ports "5000/tcp") 0).HostPort}}' $CONTAINER_NAME)
    if [ -n "$EXPOSED_PORT" ]; then
        echo "Le conteneur $CONTAINER_NAME est déjà en cours d'exécution avec le port $EXPOSED_PORT"
        exit 0
    fi
fi
# VARIABLES
#----------------------------------------------------#
RANDOM_PORT=$((RANDOM % (65535-49152+1) + 49152)) #Port externe
MAX_DURATION=$((89 * 60)) #Durée du conteneur max 1h40
DOCKER_IMAGE="$1" #Nom de l'image
#----------------------------------------------------#
# Lancer le conteneur Docker avec le port aléatoire et le nom container ("container_xxxxxxxx")
docker run -d -p $RANDOM_PORT:5000 --name $CONTAINER_NAME $DOCKER_IMAGE >/dev/null &
# Attendre 5340 minutes 
sleep $MAX_DURATION
# Supprimer le conteneur après 5340 minutes
docker stop $CONTAINER_NAME >/dev/null
docker rm $CONTAINER_NAME >/dev/null
echo "Conteneur $CONTAINER_NAME arrêté et supprimé après $MAX_DURATION secondes"