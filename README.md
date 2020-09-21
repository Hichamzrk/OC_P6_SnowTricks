# OC_P6_SnowTricks
- Réseau social en PHP/Symfony.
- Utilisation du modele MVC.
- Page d'accueil.
- Tricks.
- Espace d'authentification

## Pour commencer

Cloner le projet sur votre machine.

### Pré-requis

Ce qu'il est requis pour commencer avec votre projet : 

- Editeur de texte (Sublime, Vs code, Atom...).

### Installation

Les étapes pour installer votre programme :

- Démarrer votre serveur local.
- Upload du fichier sql qui est à la racine du projet sur votre interface de géstion de base de donnée fournie avec votre serveur local (phpmyadmin...).
- Changement des informations de connexion à la base de donnée : /.env -> ligne 32. 

### Obtenir un compte

- Modifier les informations DSN pour pouvoir s'enregistrer : /.env -> ligne 24

### Démarrage

- Lancer votre serveur local : $php bin/console server:start -d
- Compte de test : (par defaut) -Email : Exemple@test.com ; -Mot de passe : 123456
- Enjoy 
