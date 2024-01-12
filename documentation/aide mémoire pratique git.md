# Commandes Git couramment utilisées

* Cloner un référentiel :
	* git clone *URL du référentiel*
* Vérifier l'état des fichiers :
	* git status
* Ajouter des fichiers modifiés à l'index (staging area) :
	* git add *nom du fichier*
	* git add .
* Créer un commit avec les modifications de l'index :
	* git commit -m "Message de commit"
* Envoyer les commits locaux vers une branche distante :
	* git push *nom de la branche distante*
* Mettre à jour votre référentiel local avec les derniers commits de la branche distante :
	* git pull *nom de la branche distante*
* Basculer vers une autre branche :
	* git checkout *nom de la branche*
* Créer une nouvelle branche et basculer dessus :
	* git checkout -b *nom de la nouvelle branche*
* Fusionner une branche dans la branche courante :
	* git merge *nom de la branche à fusionner*
* Créer une branche distante qui suit une branche locale :
	* git push -u *nom de la branche distante* *nom de la branche locale*
* Afficher l'historique des commits :
	* git log
* Récupérer un commit spécifique dans une branche :
	* git cherry-pick *identifiant du commit*
* Annuler les modifications locales d'un fichier :
	* git checkout -- *nom du fichier*
* Annuler le dernier commit tout en conservant les modifications :
	* git reset HEAD~1
* Créer une nouvelle branche à partir d'un commit spécifique :
	* git branch *nom de la nouvelle branche* *identifiant du commit*
* Changer le nom du commit en cours avant push
  * git commit --amend
* Changer l'origine github d'un projet
  * git remote set-url origin *nouveau repo github*
