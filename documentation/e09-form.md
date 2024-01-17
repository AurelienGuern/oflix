# Episode 09

## Les formulaires

Dans symfony tout se passe avec [ce composant](https://symfony.com/doc/6.4/forms.html)

Les étapes pour utiliser un formulaire :

1. [installer le composant](https://symfony.com/doc/6.4/forms.html#installation)
2. Créer un composant formulaire avec le maker

```bash
bin/console make:form
```

3. Dans le formType créé configurer le formulaire
    - [le type de champ](https://symfony.com/doc/6.4/reference/forms/types.html)
4. Dans un controller utiliser la fonction `createForm` pour créer un formulaire
5. Toujours dans le controller fournir ce formulaire à une vue twig
    - Attention pensez à utiliser la bonne méthode `renderForm`
6. Dans la vue utiliser les [fonctions spécifiques de twig](https://symfony.com/doc/6.4/form/form_customization.html#form-rendering-functions) pour afficher le formulaire
   - Penser à utiliser form_start et form_end pour pouvoir ajouter le bouton de validation par exemple
7. Traiter le formulaire