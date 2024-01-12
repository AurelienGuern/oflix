# Challenge relation avec attributs

✋ A faire sur le projet O'flix.

## Objectifs

1. Créer l'entité `Genre` puis sa relation avec `Movie`, si pas déjà créée.
2. Créer l'entité `Person` depuis le MCD (avec `firstname` et `lastname`), si pas déjà créée.
3. Créer une entité `Casting` qui fera le lien entre `Movie` et `Person`.

Créer l'entité "Casting" telle que décrite par le schéma ci-dessous (la relation ManyToMany d'origine a été décomposée) : 

![](mcd-casting.png)

Nous appellerons cette entité `Casting` et elle contiendra deux propriétés :

### Schéma

- `role` : rôle de la personne dans le film.
- `creditOrder` ordre d'affichage de ce rôle sur la fiche du film.
- Et bien sûr les deux relations vers `Movie` et `Person` !
- Faites en sorte de créer le schéma Doctrine qui fonctionne (vérifiez avec le schéma sous Adminer si ça correspond).

### Données

- Ajoutez des données directement en BDD, à la mano.
  - Dans toutes les tables.

### Affichage

- Affichez la liste des films sur la page principale (le nom suffira, et plus si affinités).
- Affichez le détail de chaque film avec **toutes les infos du film et les infos liées** dans une page "film".
  - Soit Movie, Casting/Person, Genre.

### Bonus 

Trouver le moyen de classer automatiquement les acteurs par ordre de `creditOrder`.

## Bonus Fixtures :tada:

- Allez faire un tour du côté de [DoctrineFixturesBundle](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)) pour découvrir comment créer de fausses données automatiquement ! (il faudra tout de même créer le code / le même code que dans les contrôleurs pour manipuler les entités).
  - Avec l'exemple de la doc, vous pouvez déjà crééer des films, des genres, des personnes, à vous de voir comment les associer ensuite entre elles :wink: cela fera l'objet du prochain challenge.

## Ressources bonus / Clés composées

- Si besoin [tuto disponible sur le site de Doctrine](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/composite-primary-keys.html#use-case-3-join-table-with-metadata) (cet exemple insiste plus particulièrement sur les clés primaires _composées_ de la table de jointure).

Exemple de MLD avec clé composée (modèle logique : on précise les ids et les clés).
