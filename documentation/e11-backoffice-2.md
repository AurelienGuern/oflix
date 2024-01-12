# Episode 11

## Rappel EntityManager / Repository / Entity

### En résumé

#### Créer une nouvelle ligne en BDD

```php
// 1. créer une instance de l'entité
$newGenre = new App\Entity\Genre();
// 2. hydrater l'entité
$newGenre->setName('PHP');
// 3. ajouter l'entité à l'em
$em->persist($newGenre);
// 4. lancer les requêtes d'insertion
$em->flush();
// 5. Tada j'ai une nouvelle ligne dans ma BDD ! good job
```

#### Modifier une ligne en BDD

Ici lors de la récupération de l'entité par le repository, ce dernier "se charge de faire" le $em->persist() de tous les éléments récupérés ( cf explications ci-dessous )

```php
// 1. récupérer une entité depuis la BDD ( avec le repository ou le paramConverter si on est dans un controller )
$genre = $genreRepository->find(42);
// 2. modifier l'entité dans le code PHP
$genre->setName('Symfony');
// 3. lancer les requetes d'insertion
$em->flush();
```

### Dans le détails

Ces 3 composants sont essentiels pour gérer les données de notre application.

#### Entity

L'entity nous sert à manipuler les données de notre application dans le code PHP.
Avec un entity on va :

- modifier des valeurs ( avec les getter / setter )
- modifier les relations ( /!\ attention au propriétaire pour les Many2Many /!\ )

#### Repository

Le repository sert à effectuer des requetes de sélection dans la BDD.

Il existe 4 méthodes par défaut :

- find($id) => qui récupère UN élément par son id
- findOneBy() => qui récupère UN élément qui répond à une liste de critères ( le premier de la liste si plusieurs éléments correspondent aux critères )
- findAll() => qui récupère UN TABLEAU de tous les éléments en BDD
- findBy =>  qui récupère UN TABLEAU de tous les élément qui répondent à une liste de critères

On peut également ajouter des requêtes personnalisées selon nos besoin.
Pour cela on peut utiliser :

- du DQL ( vu en cours )
- le queryBuilder ( vu en cours )
- du SQL classique ( voir exemple des migrations )

#### EntityManager

L'entityManager ( em pour les ~flemmards~ dev ) est en charge d'exécuter les requetes de mises à jour / insertion dans la BDD.
Pour cela il tient une liste des entités à "suivre".

/!\ L'orsque l'on fait une requete à l'aide d'un repository, le résultat de la requete est ajouté à la liste des éléments à suivre de l'em ! /!\

il y a deux fonctions importantes :

- $em->persist($uneEntite) => qui va ajouter `$uneEntite` à la liste des entités à suivre ( utile si on créé une entité dans notre code PHP et que l'on souhaite l'enregistrer en BDD )
- $em->flush() => qui va constater les modifications réalisées dans les entités ( grace au code PHP ) et faire les requetes d'insertion / maj nécessaires
