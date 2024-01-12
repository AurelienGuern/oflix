# Atelier Admin O'flix

## Objectifs

Réaliser un début de back-office pour notre appli de cinéma/séries.

- **Entités Doctrine** : On est OK, on attend la sécurité pour intégrer le User.

- **Administration** : Pouvoir Lister/Afficher/Ajouter/Modifier/Supprimer une partie des entités.

## Etat des lieux

Il y a actuellement :

- Les entités : `Genre`, `Movie`, `Casting`, `Person`, `Review` et `Season`

- La partie front : liste des films (home) et page détail d'un film (movie_show) accessible à partir de la home et la possibilité d'écrire une Review sur un film/série.

Ce qu'il manque :

- Une partie d'administration du contenu existant.

- Il nous manque l'entité User mais on l'ajoutera avec la sécurité.

- _S'authentifier pour accèder à la partie back-office_ : **A ne pas faire aujourd'hui !**

Les notions que nous avons abordées jusqu'à présent :

- Les routes

- Les contrôleurs

- Les templates

- Les entités et associations

- Les fixtures

- Les formulaires

### Interface d'admin

Créer une "interface d'admin" permettant de _lister/afficher/ajouter/modifier/supprimer_ :

> Cette partie pouvant être fastidieuse, **entités conseillées en gras** (les autres pouvant se contenter de fixtures pour le moment !). _Les entités en gras permettent de mettre en évidence les relations dans les formulaires_.

- **Movie** _liée à Genre_

- **Season** _liée à Movie_

- Person

- **Casting** _liée à Movie et Person_

- Review

### Contrôleurs et templates

On fera en sorte de séparer front et back pour les contrôleurs et les templates, par ex.

- src/Controller/

  - Back/ (CRUD)

    - MovieController

    - SeasonController

    - etc.

  - Front/

    - MainController

- templates/

  - back/

  - front/

- Les routes, leurs noms et les méthodes autorisées sur celles-ci doivent être cohérentes lorsque l'on [visualise l'ensemble des routes](https://symfony.com/doc/current/routing.html#debugging-routes).

  - On aura par ex. les routes `index, show, new, edit, delete` pour chaque entité.

- Mettre les [requirements](https://symfony.com/doc/current/routing.html#parameters-validation) sur les routes avec paramètres.

- Effectuer des _redirections_ dans les actions où cela s'avère nécessaire.

### CRUD complet avec `make:crud`

- Utiliser la commande `make:crud` sur l'entité Movie ! Celle-ci vous crée CRUD complet. Ne pas hésiter à le modifier selon vos besoins !

- Form : Appliquer les types de champs adéquats et leur options éventuelles.

- Entité ! Appliquer les [contraintes de validation](https://symfony.com/doc/current/reference/constraints.html) sur les propriétés de l'entité (recommandé).

  - Vérifier les contraintes en soumettant un formulaire vide, en prenant soin de désactiver la validation HTML5.

- Appliquer le thème Bootstrap sur les formulaires.

- Afficher les _flash messages_ à l'aide d'une classe CSS cohérente partout où c'est nécessaire.

- Modifier le HTML ou les classes des différentes pages pour avoir un design un pleu plus carré (par ex. les liens et les boutons qui ne sont pas toujours très visibles, etc.).

- Une fois que votre CRUD est OK, dupliquez-le pour gérer les autres entités

### Navigation

- Ajouter un lien _Admin_ vers l'interface d'admin. Cette page contiendra du faux texte pour le moment, en revanche **toutes les pages du back auront une sous-navigation** spécifique avec tous les liens vers les listes des entités à gérer : indice, penser héritage Twig :bulb:

#### Bonus

- Gérer des messages d'erreur custom pour les erreurs 404 (not found) dès qu'il y a un `id` dans la route.

- Ajouter des fixtures pour les entités créées (Review).

- Gérer le système d'étoiles du rating (affichage Twig).

- Recherche d'un film depuis la barre de recherche.

- Vérifier le comportement des suppressions en cascade.

- Vérifier si on peut créer des fragments de template réutilisables dans les Twig.
