# E12 - Sécurité

## La Sécurisation ( en général )

On retrouve toujours ces 4 étapes lorsque l'on veut sécuriser un système

1. Enregistrement dans le système
2. Authentication
   - Identification
3. Se souvenir que l'utilisateur s'est authentifié
   - Session
4. Authorization
   - Roles
   - autoriser certaines à certains user ( ACL )

## Mise en place dans Symfony
'input' => 'datetime',
Tout se passe ici : https://symfony.com/doc/6.4/security.html

### Enregistrement dans le système

1. Installer le composant `composer require symfony/security-bundle`
2. Créer une entité qui va nous servir de base pour l'authentification `bin/console make:user`
3. Pour générer un mot de passe `bin/console security:hash-password`

### Authentification

Créer un controller et le configurer comme indiqué [dans la documentation](https://symfony.com/doc/6.4/security.html#form-login)

1. controller
2. fichier security.yaml
3. vue
