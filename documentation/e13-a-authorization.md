# E13

## Authorization

Une fois l'utilisateur connecté, il y a plusieurs facon d'empecher l'accès à une page

1. dans le security.yaml ( pratique pour protéger de grandes sections du site rapidement )
2. dans le controller
   1. par annotation ( sur la classe ou sur une route en particulier grace à l'annotation `IsGranted`)
   2. en PHP avec la fonction `$this->denyAccessUnlessGranted()`
3. dans la vue  avec `is_granted`

## Les Voters

Dans le cas ou les règles de gestion ne sont pas "simples", on peut créer des voters personnalisés pour gérer les droits d'accès

```bash
bin/console make:voter
```

Dans la classe créée les méthodes `supports` et `voteOnAttribute` doivent renvoyer un booléen en fonction des paramètres fournis.

`supports` répond à la question : Veux tu voter ( pour cet attribut et cet objet ) ?
`voteOnAttribute` répond à la question : Quel est ton vote ( pour cet attribut et cet objet et l'utilisateur courant ) ?
