# Here We Go 

**Here We Go** est une plateforme web de partage d'événements et de covoiturage. Elle permet de découvrir des événements (musique, culture, loisirs…), d'y participer et de s'y rendre en covoiturage avec d'autres participants.

##  Contexte

Ce projet a été réalisé dans le cadre de notre **formation à l'ISFAC**, en tant que **projet fil rouge**.
C'est l'un de nos plus gros projets : il nous a accompagnés tout au long de la formation et nous a permis de mettre en pratique l'ensemble des compétences acquises (conception de base de données, architecture MVC, développement back-end en PHP, intégration front-end, gestion des rôles et de la sécurité…).

##  Auteurs

Projet réalisé à deux par :

- **Dylan Peltier**
- **Quentin Blairet**

##  Fonctionnalités

### Événements
- Consultation des événements à la une et par catégorie (musique, culture, loisirs…)
- Page de détail d'un événement
- Recherche par mot-clé, période et département
- Recherche d'événements à proximité (selon le département de l'utilisateur)
- Page « Tente ta chance » : recommandations d'événements selon les catégories préférées de l'utilisateur
- Création, modification et suppression d'événements
- Export CSV des événements

### Covoiturage
- Proposition d'un covoiturage pour un événement (véhicule, places disponibles, montant, description, photo)
- Demande pour rejoindre un covoiturage
- Validation ou refus des demandes par le conducteur
- Suivi de « Mes événements » et de mes covoiturages

### Utilisateurs
- Inscription et connexion (mots de passe hachés avec `password_hash`)
- Profil utilisateur
- Notifications (nouvelles demandes, validations…)
- Autocomplétion du code postal et de la ville lors de la saisie

### Administration
- Tableau de bord administrateur
- Validation des comptes en attente
- Gestion des utilisateurs, des événements et des covoiturages

## Technologies

- **PHP** (orienté objet, architecture **MVC**)
- **MySQL** via **PDO**
- **HTML / CSS**, **Bootstrap** et Bootstrap Icons
- **JavaScript** (requêtes AJAX pour l'autocomplétion)

## Structure du projet

```
herewego/
├── index.php          # Point d'entrée de l'application
├── routes.php         # Routage contrôleur / action
├── connexion.php      # Connexion à la base de données (singleton PDO)
├── controller/        # Contrôleurs (événements, covoiturages, utilisateurs, notifications…)
├── models/            # Entités et managers (accès aux données)
├── views/             # Vues (pages, admin, événements, covoiturages, utilisateurs…)
└── asset/             # Styles, scripts, images et polices
```

Les URLs suivent le format : `index.php?controller=<controleur>&action=<action>`
(ex. `?controller=evenement&action=list`).

## Licence

Projet pédagogique réalisé dans le cadre de la formation ISFAC.
