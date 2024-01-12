# Challenge ajout de données avec DoctrineFixturesBundle

> Les jeux de données de "test" sont cruciaux pour démarrer un projet. Ils permettent:
>
> - Pour un projet cloné, d'initialiser un jeu de données initiales.
> - La possibilité à tout moment de réinitialiser les données de développement.
> - Et surtout, ne plus s'embêter à créer les données à la main ou à faire transiter des fichiers .sql de données...
> - Cerise sur le gâteau, cela nous motive un peu plus pour travailler !

## Objectifs

- **Générer des données dans toutes les tables** via `DoctrineFixturesBundle`.
- Vérifier que les pages `list` et `show` s'affichent correctement.

**Vous avez 2 challenges disponibles au choix**, choisissez celui qui vous intéresse le plus.

### Conseils

- Commencez "petit" et avancez par étapes.
- Ne pas hésiter à exécuter `php bin/console doctrine:fixtures:load` à outrance.
- Have fun :)

## Option 1. Tout à la mano, pour comprendre ce qu'on fait

- A partir du début de code fourni [et/ou de cette documentation](https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html), créez des données dans toutes les tables.
- Utilisez des boucles pour créer ces données. Sans relations.
  - => Cette partie ne devrait pas poser de soucis.
- Associez les entités liées entre elles, si possible sans doublons.
  - => Pensez à stocker vos entités dans des listes pour pouvoir les retrouver ensuite (usage malin du random, afin de piocher dans ces listes).
- Idéalement, créer des classes et des méthodes vous renvoyant des données préconçues (un film au hasard parmi une liste de films, etc.).
  - Une classe contenant des tableaux de données par entité, et des méthodes d'accès pour récupérer ces entités au hasard.

### Bonus : Ajout de Faker, données factices réalistes

#### Instructions

- Utiliser [la libraire Faker PHP](https://fakerphp.github.io/) pour **générer des données réalistes** ou un minimum cohérentes.
- **Créer un ou plusieurs `Faker Provider`** afin de fournir à Faker un generator, par ex. pour `Movies`, `Person` ou `Genres`.
  - C'est le même principe que les classes de données préconçues de l'option 1.

  - Deux repository de données
    - Cinéma : composer require xylis/faker-cinema-providers
    - Photos : composer require bluemmb/faker-picsum-photos-provider ^2.0

## Option 2. NelmioAliceBundle : le tout-en-un (vraiment si vous avez du temps)

Plusieurs bundles existent, souvent basé sur Faker, proposent une approche plus basée sur la configuration des fixtures que sur leur écriture en code. C'est le cas de `NelmioAliceBundle`.

- Adapter/refaire partiellement ou totalement les fixtures existantes en utilisant le bundle `nelmio/alice` en vous basant sur [cette Fiche Récap'](https://kourou.oclock.io/ressources/fiche-recap/fixtures-avancees-avec-nelmio-alice/).

## Bonus Recherche de l'exo custom queries

- Sur l'exercice 1, modifier la méthode pour ajouter la recherche d'un film sur tout ou partie de son titre. Le mot-clé de recherche sera un paramètre optionnel de la méthode.
