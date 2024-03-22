#!/bin/bash
#l'ID du dernier conteneur Docker lancé
container_id=$(docker ps -lq)
# Vérifie si un conteneur a été trouvé
if [ -z "$container_id" ]; then
    echo "Aucun conteneur Docker n'a été trouvé."
    exit 1
fi
#port externe du conteneur
external_port=$(docker port "$container_id" 2>/dev/null | awk -F '->' '{print $2}' | awk -F ':' '{print $2}')
# Vérifier si le port externe a été récupéré avec succès
if [ -z "$external_port" ]; then
    echo "Impossible de récupérer le port externe du conteneur Docker."
    exit 1
fi
echo "$external_port"