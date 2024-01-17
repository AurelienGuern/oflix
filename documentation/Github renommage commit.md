# Modification du nom d'un commit existant et déjà poussé

## Accédez à la branche appropriée

Assurez-vous que vous êtes sur la branche où se trouve le commit que vous souhaitez modifier.

```bash
git checkout <nom_de_branche>
```

## Utilisez git rebase

Commencez un rebase interactif pour le dernier commit en utilisant la commande suivante. Remplacez <commit_id> par l'ID du commit précédent celui que vous souhaitez modifier.

```bash
git rebase -i <commit_id>^
```

Notez le ^ après l'ID du commit. Cela indique à Git de commencer le rebase depuis le commit précédent.

## Modifier le commit

Une fois que le rebase interactif est démarré, une liste de commits s'affichera dans votre éditeur de texte par défaut. Localisez le commit que vous souhaitez modifier, changez le mot `pick` en `reword`, puis enregistrez et fermez l'éditeur.

```bash
pick <commit_id> Message du commit
```

Modifiez en

```bash
reword <commit_id> Nouveau message du commit
```

## Modifier le message du commit

Après avoir enregistré et fermé l'éditeur, un nouvel éditeur s'ouvrira pour le commit que vous souhaitez modifier. Modifiez le message du commit selon vos besoins, puis enregistrez et fermez l'éditeur.

## Terminer le rebase

Après avoir modifié le message du commit, vous avez terminé le rebase. Utilisez la commande suivante pour finaliser le rebase.

```bash
git rebase --continue
```

## Forcer le push

Une fois le rebase terminé, vous devrez forcer le push pour mettre à jour le dépôt distant avec vos modifications.

```bash
git push origin <nom_de_branche> --force
```

Assurez-vous d'être conscient des implications du push forcé, en particulier si d'autres collaborateurs travaillent sur la même branche.
