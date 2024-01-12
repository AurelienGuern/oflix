# Méthode de travail en équipe avec Git

- [Méthode de travail en équipe avec Git](#méthode-de-travail-en-équipe-avec-git)
  - [Branches du modèle Gitflow](#branches-du-modèle-gitflow)
  - [Branches `feature`](#branches-feature)
  - [Branche `develop`](#branche-develop)

Vous utilisez probablement [Git](https://kourou.oclock.io/ressources/fiche-recap/git-et-github/) pour la première fois en équipe, et cela peut vous intimider. Pas de panique ! Il existe en effet des méthodes de travail pour faciliter et encadrer cela.

Dans une lecture, nous vous avions parlé du workflow Gitflow. Le [lien](https://danielkummer.github.io/git-flow-cheatsheet/index.fr_FR.html) était celui d'un outil qui permet de mettre en œuvre ce workflow plus facilement. Néanmoins, il est bien important de comprendre les commandes qui se cachent derrière cet outil.

Pour l'histoire, cet outil ne fait que traduire une méthode initialement expliquée en 2010 dans un [article par Vincent Driessen](https://nvie.com/posts/a-successful-git-branching-model/). Ce modèle reste toujours très utilisé dans le milieu professionnel.

## Branches du modèle Gitflow

Le modèle de Vincent Driessen s'appuie sur plusieurs branches, avec chacune des utilités bien distinctes.

Il y a tout d'abord 2 branches principales :

- `main` (ou `master`)
- `develop`

`main` est la branche principale du projet, celle qui accueille le code prêt pour une mise en production.

`develop` est la branche... de développement :sweat_smile: Elle réceptionne **toutes** les nouvelles fonctionnalités, et permet ainsi de s'assurer que tout est fonctionnel, avant de passer sur `main`. C'est généralement la branche de la préprod.

<img src="https://nvie.com/img/main-branches@2x.png" height=400>

Toujours selon le modèle de Vincent Driessen, on peut retrouver ensuite 3 types de branches supplémentaires.

- les branches de `feature`
- les branches de `release`
- les branches de `hotfix`

Nous ne développerons pas ici les deux dernières (tout est expliqué dans les liens donnés plus haut, et leur utilisation n'est pas nécessaire en apothéose), pour nous concentrer uniquement sur les branches de `feature`.

## Branches `feature`

Les branches de *feature* sont généralement nommée `feature/nom-de-la-feature`.

On les crée depuis la branche `develop` **à jour** :

```bash
# On se rend sur la branche "develop"
$ git checkout develop
# On s'assure qu'elle soit à jour
$ git pull
# On crée la branche "feature/nom-de-la-feature" depuis "develop"
# et on bascule dessus
$ git checkout -b feature/nom-de-la-feature develop
```

C'est ensuite sur ces branches que vous allez coder, faire des commit et des push.

Une fois la fonctionnalité terminée, il faut la fusionner (*merge* en anglais) avec la branche `develop`

<img src="https://nvie.com/img/fb@2x.png" height=400>

Pour ceci, plusieurs options :

- faire une PR depuis l'interface de GitHub
  - cela permet de discuter de la PR depuis le site de GitHub,
  - cela permet aussi une validation par les pairs,
  - il est parfois possible de résoudre des conflits depuis le site de GitHub
  - c'est la méthode que nous aurions à vous recommander dans le cadre de l'apothéose :slightly_smiling_face:
- utiliser les lignes de commande :

```bash
# On retourne sur la branche "develop"
$ git checkout develop
# On fusionne notre branche "feature/nom-de-la-feature"
$ git merge --no-ff feature/nom-de-la-feature
# Potentiellement, on résout les conflits
# On push la nouvelle version de "develop"
$ git push origin develop
```

Explication du flag `--no-ff` :

Ce flag crée **dans tous les cas** un commit de merge, y compris quand il n'y a pas de conflit à résoudre. Cela permet d'avoir un historique plus clair (on continue de faire référence à la branche de `feature`) et aussi de revenir en arrière plus facilement si besoin.

<img src="https://nvie.com/img/merge-without-ff@2x.png" height=400>

:warning: Ne pas oublier de pull `develop` avant de repartir sur une nouvelle branche `feature/...`. Cela permet d'avoir la dernière version à jour de `develop`.

:information_source: En cas de bug constaté une fois le merge sur `develop` réalisé : 

1. On retourne sur la branche de la feature concernée
2. On corrige le bug
3. On commit
4. On reprend les étapes précédemment décrites pour fusionner sa branche avec `develop`

C'est seulement une fois les bugs résolus qu'on peut supprimer la branche de feature.

## Branche `develop`

Imaginons que vous ayez terminé plusieurs fonctionnalités (=*features*) que vous vouliez mettre en production.

Au fur et à mesure de la réalisation de ces fonctionnalités, vous les avez fusionné avec la branche `develop`. C'est donc maintenant cette branche qu'il faut fusionner avec `main`.

On se retrouve en fait face aux mêmes options citées plus tôt :

- faire une PR depuis l'interface de GitHub
- utiliser les lignes de commande :

```bash
# On retourne sur la branche "main"
$ git checkout main
# On fusionne notre branche "develop"
$ git merge --no-ff develop
# Potentiellement, on résout les conflits
# On push la nouvelle version de "main"
$ git push origin main
```