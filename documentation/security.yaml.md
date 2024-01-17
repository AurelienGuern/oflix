# Explication du security.yaml

## password_hashers (Hachage de mot de passe)

Cet élément spécifie la gestion des hachages de mot de passe. Il indique que pour les utilisateurs implémentant l'interface `Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface`, le hachage du mot de passe doit être géré automatiquement (`auto`). Cela signifie que Symfony utilisera la méthode de hachage configurée par défaut pour ces utilisateurs, soit `bcrypt`.

## providers (Fournisseurs d'utilisateurs)

Dans cette configuration, un fournisseur de mémoire appelé `users_in_memory` est défini. Il s'agit d'un fournisseur en mémoire où les informations sur les utilisateurs sont stockées en mémoire. Cela est utile pour le développement et les tests, mais dans un environnement de production, vous utiliseriez  un fournisseur de données persistantes comme Doctrine.

## firewalls (pare-feu)

### dev

Ce pare-feu est conçu pour les environnements de développement. Il permet un accès sans restriction aux ressources telles que le profiler, la barre d'outils Web Debug (WDT), et les fichiers CSS, images et JS. Cela facilite le débogage en développement.

### main

Ce pare-feu principal est configuré avec l'option `lazy` à `true`, ce qui signifie que le pare-feu ne sera initié que lorsqu'il sera nécessaire. Le fournisseur d'utilisateurs pour ce pare-feu est spécifié comme étant `users_in_memory`, le fournisseur défini précédemment.

## access_control (Contrôle d'accès)

Cet élément est utilisé pour spécifier les règles de contrôle d'accès. Les règles définies ici indiquent quelles URL nécessitent une autorisation spécifique. Par exemple, l'accès à toutes les ressources sous le chemin `^/(_(profiler|wdt)|css|images|js)/` est ouvert au public, tandis que le pare-feu principal (`main`) utilise le fournisseur `users_in_memory`.

## conclusion

Cette configuration de sécurité indique comment gérer les hachages de mot de passe, où trouver les informations sur les utilisateurs, quels accès sont autorisés dans les environnements de développement, et comment contrôler l'accès aux différentes parties de l'application.
