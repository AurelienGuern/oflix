# 1. Sur O'flix : Challenge User + User login

## Sur O'flix, créer l'authentification via `make:user`

Sé référer à la documentation [Guides > Security](https://symfony.com/doc/current/security.html)

> Parcourez la doc dans ses grandes lignes, utilisez ce qui vous parait judicieux/accessible.

=> C'EST FAIT !

## Création du form de login

Voir la documentation [Guides > Security > How to Build a Login Form](https://symfony.com/doc/current/security/form_login_setup.html)

=> C'EST FAIT !

### Logout

Voir la doc (en bas de page "Logging Out") : https://symfony.com/doc/current/security.html#logging-out

=> C'EST FAIT !

# 2. Challenge Utilisation des Rôles

## Restrictions d'accès

> Créez plusieurs users via Adminer ou créez des _Fixtures_ (encore mieux). Utilisez la commande `security:hash-password` pour hacher vos mots de passe.

Configurer `access_control` dans `config/packages/security.yaml` pour : 

- **Admin** : Sécuriser toutes les routes `/add` `/edit` `/delete` avec **ROLE_ADMIN**.
- **Admin** : Si **ROLE_MANAGER** : accès aux pages de **listes** movie, genres etc. et pages **show** (si existantes).
- **Front** : Si **ROLE_USER** : ajouter une critique sur un film.
- **Front** : Si user **ANONYME** : page d'accueil + fiche film seulement.

## Front, inté, Twig

- **Dans le menu** :
    - **Afficher une info** dans le menu contenant :
        - email
        - role = Visiteur, Membre, Manager ou Administrateur
    - **Afficher un bouton** _Connexion_ ou _Déconnexion_ en fonction de l'état de connexion du User.

## Bonus Fixtures

Si pas déjà fait, ajouter aux Fixtures 3 users "en dur", user@user.com, manager@manager.com, admin@admin.com, avec des mots de passe hachés avec la console Symfony.

## Bonus CRUD

Créer le CRUD avec la ldc `php bin/console make:crud`, sur l'entité User. Ou faites-le en copiant MovieController le cas échéant :wink:

- **Vérifiez toutes les pages**, régler les erreurs si nécessaire.
- **Trouver un moyen d'attribuer des rôles à l'utilisateur** depuis l'interface d'admin (menu déroulant avec les choix, entité liée avec les droits dedans, au choix). N'oubliez pas que User->getRoles() retourne un **tableau** contenant le ou les droits du user.

### Bonus : Encodage du mot de passe à la sauvegarde de l'utilisateur

Depuis votre interface CRUD :

- A l'ajout d'un utilisateur
- A l'édition d'un utilisateur

Principe : injecter `UserPasswordHasherInterface $passwordHasher` dans votre action de contrôleur et utiliser la méthode `hashPassword()` de `$passwordHasher` : 

```php
$passwordHasher->hashPassword($user, 'the_new_password');
```

## Méga-Bonus Regex

- Sur https://regexone.com/problem/matching_decimal_numbers, faites les "exercices pratiques".

## Support

[Fiche récap' sur les  Rôles](https://kourou.oclock.io/ressources/fiche-recap/symfony-roles/)