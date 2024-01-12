# Challenge Symfony Form sur O'flix

## Avant de démarrer

- Utiliser la description de  `Review.php` pour générer l'entité dans votre projet.
  - username    (string 50)
  - email       (string 255)
  - content     (text)
  - rating      (float)
  - reactions   (json)
  - watchedAt   (DateTimeImmutable)
  - movie       (ManyToOne Movie)

- Exécuter `bin/console make:entity Review`
- => Cela va créer l'entité et la classe de Repository.
- Créer une migration et l'exécuter 😉

## Ajout d'un formulaire de critique sur un film

Etapes possibles :

- Créer une classe de formulaire, comme vu en cours, via `bin/console make:form` sur l'entité `Review`
- Créer un bouton/lien depuis la page d'un film : _"Ajouter une critique"_.
- Afficher le formulaire sur la page dédiée _"Ajouter une critique sur le film (nom du film)"_.
  - A faire tout de suite ou après un premier test du form : ajouter des contraintes de validation (et désactiver la validation HTML5).
- Traiter le form et afficher la review valide dans un `dd()` pour vérification.
- Une fois la vérificatoin faite, sauvegarder l'entité en BDD (supprimer le `dd()`).
- Rediriger vers la page du film et afficher les critiques associées.

### Références doc Symfony

- [Guides > Forms](https://symfony.com/doc/current/forms.html)
- [Best Practices > Forms](https://symfony.com/doc/current/best_practices.html#forms)
- [Référence des types de champ](http://symfony.com/doc/current/reference/forms/types.html)
- [Référence des contraintes de validation](http://symfony.com/doc/current/reference/constraints.html)

### Fiches Récap'

- [Forms + Entités Doctrine](https://kourou.oclock.io/ressources/fiche-recap/formulaires-avec-symfony/)

## Champs du formulaire

- **FormType** _(Type de champ à trouver dans la doc)_
  - **_Label_ : Contraintes** _(Type de contrainte à trouver dans la doc)_

- Text
  - _Username_ : NotBlank

- Email
  - _E-mail_ : NotBlank, Email

- Textarea
  - _Critique_ : NotBlank, Length mini = 100

- Choice Select/Note de 5 à 1 (un seul choix possible)
  - _Avis_ : Excellent, Très bon, Bon, Peut mieux faire, A éviter.

- Choice Checkboxes/Tableau de valeurs possibles (smile, cry, think, sleep, dream) (plusieurs choix possibles)
  - _Ce film vous a fait_ : Rire, Pleurer, Réfléchir, Dormir, Rêver.

- Date
  - _Vous avez vu ce film le_ : Date...

Mettre le bouton de soumission dans le template (cf Best Practices).

## Thème Bootstrap

Comme indiqué vu en cours, vous pouvez activer un thème global Bootstrap pour les formulaires depuis `twig.yaml` : [form bootstrap](https://symfony.com/doc/current/form/bootstrap5.html) ex. :

```twig
# config/packages/twig.yaml
twig:
    form_themes: ['bootstrap_5_layout.html.twig']
```

## Bonus : calcul du rating

Objectif:

- Lors de l'ajout d'une critique, calculer le nouveau `rating` du film associé à la critique.

### Avant de foncer dans le code

On calcule le `rating` d'un film en faisant la moyenne des notes de toutes les critiques de ce film.

Mais si il n'y a pas de critique, un film ne devrait pas avoir de note.

Pour cela, on va modifier notre MCD/MPD pour dire que le `rating` d'un film est `null` par défaut.

Cette modification va aussi modifier notre affichage:

- Si il n'y a pas de `rating` on affiche un message "Ce film n'a pas reçu assez de critiques"
- Sinon on affiche la note et les étoiles.
