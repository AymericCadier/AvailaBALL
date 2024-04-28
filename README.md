# Bienvenue sur le Git de Availaball !

### L'objectif de ce projet Symfony est de permettre aux utilisateurs de trouver des terrains de sport disponibles pour jouer au football, au basket, au tennis, etc. Ils peuvent démarrer une session sur ces terrains, et aussi créer des évènements pour ceux-ci (par exemple un tournoi)


# Structure et modélisation

- **Nous avons implémenté une structure MVC utilisant la bibliothèque twig**


- **Voici le modèle E/R associé à notre base de données :**

  
![image](https://github.com/AymericCadier/AvailaBALL/assets/145613132/eb4a8a2d-1bc0-4293-958f-a1003c637166)


# Nos fonctionnalités :

- **Admin**  : `deleteUser` , `validateEvent` , `refuseEvent`


- **User** : `read` , `update` , `delete` (ne supprime pas de la base de données)


- **Events** : `create` (l'évènement crée devra être validé par un admin) , `read`


- **Security** : `login`, `register`, `logout`


- **Playground** : `read` (trois pages différentes : index, foot et basket)


- **messages** : `create` , `read` , `update` , `delete`


- **sessions** : `create` , `end` (met fin à la session, ne la supprime pas de la bd)


- **page de contact** (nous envoyant un mail contenant les données fournies)


# Installation

1. Clonez le projet sur votre machine


2. Installez les dépendances avec la commande `composer install`


3. Créez un fichier `.env.local` à la racine du projet et ajoutez-y les informations de connexion à votre base de données


4. Créez la base de données avec la commande `php bin/console doctrine:database:create`


5. Créez les tables de la base de données avec la commande `php bin/console doctrine:migrations:migrate`


6. Installez les fixtures avec la commande `php bin/console doctrine:fixtures:load` 
(_pour assurer leur insertion, il faut temporairement désactiver l'auto-incrémentation des clés primaires de la table User et Playground_)

_A noter que les étapes 4 à 6 peuvent être évitées si vous importez le fichier sql fourni à la racine_


# Extras

Nous avons mis en place un système de contact dans lequel les utilisateurs peuvent nous envoyer des retours que nous recevrons par mail (à l'aide de l'api mailjet). Si vous désirez vérifier l'effectivité de cette fonctionnalité, voici le mail associé et son mot de passe :
- mail : adrian-jimenez-symfony@outlook.fr
- Availaball*2024

_A noter que l'api fonctionnant de manière irrégulière, il est probable qu'il faille faire deux ou trois envois pour recevoir un mail_

