# Episode 10

## FORM - Les contraintes de validation

On peut ajouter des contraintes de validations des données saisies dans un formulaire
( la validation se fait lorsque l'on exécute `$form->isValid()` dans le controller)

Pour les ajouter il y a deux façons de faire :

1. dans la classe de formulaire ( avec l'option `constraints`)
2. [en attributs dans l'entité](https://symfony.com/doc/6.4/reference/constraints/Length.html#basic-usage) ( méthode conseillée car plus modulable )

## Rappels Migrations

1. Toujours garder la cohérence entre les entités, les migrations et la BDD
2. S'assurer que la migration ne cause pas de perte de données
   1. Si nécessaire, on doit ajouter des requetes de récupération de données
3. Ne pas supprimer les migrations que l'on a push (sauf si on n'est pas sûr auquel cas on supprime toutes les migrations et on en refait une propre)

### Les solutions en dev

Tant que l'on est en dev, on peut supprimer notre BDD et la recréer.

```bash
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
(bin/console make:migration)
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
bin/console doctrine:schema:validate
```
