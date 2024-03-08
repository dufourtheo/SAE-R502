Voici un exemple de README.md pour votre projet SAE R502 (Automatisation de tâches) :

# Projet SAE R502 - Automatisation de Tâches

Ce projet vise à automatiser certaines tâches liées à la gestion des conteneurs Docker sur une machine VPS distante. L'objectif principal est de récupérer le nombre d'images Docker disponibles sur cette machine.

## Fonctionnalités

- Conteneurisation de l'API : L'API est conteneurisée pour faciliter le déploiement et l'isolation.
- Récupération du nombre d'images Docker : L'API permet de récupérer le nombre d'images Docker disponibles sur la machine VPS distante où tournent les conteneurs.
- Interface Web Symfony : Une interface utilisateur est créée avec Symfony, incluant un formulaire pour insérer le nom de l'image associée à un challenge.

## Configuration Requise

- Docker
- Symfony

## Installation et Utilisation

1. Cloner le dépôt GitHub :

```
git clone https://github.com/dufourtheo/SAE-R502.git
```

2. Construire et lancer le conteneur Docker de l'API :

```
cd projet-sae-r502/api
docker build -t mon-api .
docker run -d -p 8080:8080 mon-api
```


## Captures d'écran

- ![Capture d'écran de l'interface Symfony avec le formulaire](img/Formulaire.gif)
- ![Capture d'écran côté DB](img/screendb.png)

## Auteur

Ce projet a été réalisé par [DUFOUR THEO](https://github.com/dufourtheo).

## Licence

Ce projet est en lien avec Hackcess