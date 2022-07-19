# Projet-22-Qualiextra


Qualiextra a pour but de vendre des expériences personnalisées aux épicuriens.

Expériences hôtelières (nuitée + activité) ou expériences gustatives (menu à l’aveugle, dégustation de spiritueux) etc à des particuliers (B to C).
Ces packages seront accessibles 100% en ligne aux clients depuis une application web.
La société référence aussi une sélection d’établissements qui ne proposent pas    d’expériences afin de proposer des lieux atypiques aux visiteurs de la plateforme.

## Installation

Afin d'installer le projet, nous vous proposons de suivre le processus suivant :

1. Installation du composer :

`composer install`

Cette commande permet d'installer, les bundles en fonction de ce que nous avons dans le fichier composer.json.

2. Création du lien avec la base de donnée (BDD)

Dans votre outils de gestion de base de donnée (adminer, phpmyadmin,..) créer un utilisateur.

Dupliquer le fichier env.test et le renommer en env.local

Vérifier votre version de mysql ou mariadb en éxécutant cette commande : `mysql -V`

Insérer cette ligne : 
`DATABASE_URL="mysql://identifiant:motdepasse@127.0.0.1:3306/qualiextra?serverVersion=mariadb-10.3.25&charset=utf8mb4`

Changer l'identifiant et le mot de passe avec les vôtres de la chaîne de connection .

3. Exécuter cette commande dans le terminal qui permet de créer la base de donnée
    `bin/console doctrine:database:create`

4. Afin de générer les table excuter ces commandes dans le terminal :
   `bin/console make:migration`
puis `bin/console doctrine:migration:migrate`

Votre BDD est prête.

Le projet est okay
