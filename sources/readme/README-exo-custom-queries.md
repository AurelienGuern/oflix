# Doctrine custom queries

> Objectif : Comprendre l'intérêt du Repository d'une entité et l'utiliser sur des exemples concrets.

## Exercice 1

Créer une méthode custom sur `Movie` pour récupérer la liste des films et série par ordre alphabétique / via DQL ou QueryBuilder.
1. Ecrire la requête custom dans le Repository de l'entité.
2. Utiliser la requête dans la page "Films et séries".
3. Utiliser une variante de la requête pour afficher les 10 derniers films et séries les plus récentes sur la page d'accueil.

## Exercice 2

Problématique : Notre code fait actuellement autant de requêtes qu'il y a de castings associés à un acteur. On peut le voir dans la Toolbar.

Créer une méthode custom sur `CastingRepository` pour récupérer tous les castings d'un film donné.

1. Recommandé : Ecrire la requête SQL dans Adminer pour comprendre l'intérêt d'une telle requête.
2. Ecrire la requête custom dans le Repository.
3. Utiliser la requête sur la page qui affiche le détail du film.

## Bonus Recherche

- Sur l'exercice 1, modifier la méthode pour ajouter la recherche d'un film sur tout ou partie de son titre. Le mot-clé de recherche sera un paramètre optionnel de la méthode.

# Ressources

- Documentation Symfony : https://symfony.com/doc/current/doctrine.html#querying-for-objects-the-repository