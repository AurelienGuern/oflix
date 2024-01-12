# Workflow du formulaire

![Workflow formulaire Symfony](Workflow%20formulaire%20symfony.jpg )

## 1. Création ou récupération de l'entité

:warning: Depuis une requête HTTP en GET, on affiche un formulaire.

On a une entité `$review`.

Par ex. `$review = new Review();`

## 1bis. Création du formulaire

À partir d'un `Type` ici `ReviewType` , et en lui transmettant l'entité par défaut, ici `$review`.

Par exemple `$form = $this->createForm(ReviewType::class, $review);`

## 2. Rendu du formulaire en HTML

```php
return $this->render('review/index.html.twig', [
    'form' => $form,
]);
```

```twig
{{ form_start(form, {'attr': {'novalidate': 'novalidate', 'class': 'review-form' }}) }}
    {{ form_widget(form) }}
    <button type="submit" class="btn btn-success">Ajouter</button>
{{ form_end(form) }}
```

Le formulaire transforme ces données de l'entité en HTML selon la configuration de chaque champ du `ReviewType`.

:warning: A ce stade, la réponse est envoyée au client !

## 3. Soumission du formulaire HTML

Envoi d'une requête HTTP au serveur.

## 4. Récupération de la requête HTTP par Symfony

... et conversion en objet `$request`.

Récupération dans la méthode par injection de dépendance :

```php
public function new(Movie $movie, Request $request)
```

## 4bis. Traduction de la requête vers le formulaire

Le formulaire prend les données reçues, **qui ne sont que des chaines de caractères** (parfois sous forme de tableau).

Le formulaire cherche à transformer ces données en objets PHP selon la configuration de chaque champ du `ReviewType`.

## 5. Passage à l'entité

Les données converties selon la configuration des champs sont transmises à l'entité via ses setters.

À ce moment-là, il peut y avoir des erreurs si le type attendu par l'entité n'est pas cohérent avec celui défini par le champ.

Sinon, tout va bien, on passe à la validation.

## 6. Validation de l'entité

A ce stade, on appelle le Validator qui applique les contraintes `#[Assert\xxxxxxx]` que l'on a définies sur l'entité.

En cas d'erreurs, on réaffiche le formulaire avec les erreurs.

## 7. Sauvegarde en base

Une fois l'entité validée, on en fait ce qu'on veut, par exemple, la sauvegarder en base.
