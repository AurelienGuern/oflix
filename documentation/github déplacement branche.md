# déplacement d'un branche <branch> vers un autre commit 4e896

* Se positionner sur une autre branche <other>

```bash
git checkout <other>
```

* Déplacer la branche vers le nouveau commit

```bash
git branch -f <branch> 4e896
```

* revenir sur la branche

```bash
git checkout <branch>
```

* la pousser vers origin

```bash
git push --force origin <branch>
```
