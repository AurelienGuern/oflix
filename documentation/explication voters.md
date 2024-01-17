# Les voters pour les nuls

Les "voters" (ou électeurs en français) dans Symfony sont un mécanisme permettant de prendre des décisions d'autorisation dans une application web. En d'autres termes, les "voters" déterminent si un utilisateur a le droit d'effectuer une action particulière dans l'application.

Voici une explication simple en plusieurs points :

## Qu'est-ce qu'un "voter" ?

Un "voter" est une classe PHP dans Symfony qui implémente l'interface VoterInterface.
L'interface VoterInterface oblige la classe à mettre en œuvre certaines méthodes qui définissent les règles de décision d'autorisation.

## Quel est le rôle d'un "voter" ?

Un "voter" répond à la question : "Est-ce que cet utilisateur a le droit d'effectuer cette action ?".
Chaque "voter" est responsable de la décision pour une action spécifique ou une classe d'actions.

## Comment utiliser un "voter" ?

Dans Symfony, les "voters" sont généralement utilisés avec le système de contrôle d'accès (Access Control) pour sécuriser différentes parties de votre application.
Vous configurez les "voters" dans le fichier de configuration de sécurité (security.yaml) en indiquant quel "voter" doit être utilisé pour quelle action.

## Schéma explicatif

![Schéma Voter](explication%20voter.drawio.png)

## Exemple simple d'utilisation de "voters"

Supposons que vous ayez une entité Post et vous voulez autoriser un utilisateur à éditer un post uniquement s'il est l'auteur du post.
Vous pouvez créer un "voter" qui implémente la logique de décision pour cette règle spécifique.

```php
// Exemple simplifié d'un voter pour la gestion des posts
class PostVoter implements VoterInterface
{
    public function supports(string $attribute, $subject): bool
    {
        return $attribute === 'EDIT_POST' && $subject instanceof Post;
    }

    public function vote(TokenInterface $token, $subject, array $attributes): int
    {
        $user = $token->getUser();

        // Si l'utilisateur n'est pas connecté, il n'a pas le droit
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        // Si l'utilisateur est l'auteur du post, il a le droit
        if ($subject->getAuthor() === $user) {
            return VoterInterface::ACCESS_GRANTED;
        }

        // Sinon, il n'a pas le droit
        return VoterInterface::ACCESS_DENIED;
    }
}
```

## utiliser un "voter" dans un contrôleur Symfony

### Utilisation du "voter" dans une action du contrôleur

Ensuite, utilisez le "voter" pour vérifier si un utilisateur a le droit d'effectuer une action spécifique.

```php

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;

class PostController extends AbstractController
{
// ...

public function edit(Post $post): Response
{
    // Utilisation du "voter" pour vérifier si l'utilisateur peut éditer le post
    $this->denyAccessUnlessGranted('EDIT_POST', $post, 'Vous n\'êtes pas autorisé à éditer ce post.');

    // Si nous arrivons ici, l'utilisateur a le droit d'éditer le post

    // ... logique d'édition du post ...

    return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
}

// ...
}
```

### Explication du code

La méthode `$this->denyAccessUnlessGranted` est utilisée pour vérifier si l'utilisateur actuel a le droit d'accéder à une certaine action.
Elle prend comme premier argument le nom de l'action (qui correspond à l'attribut utilisé dans le "voter").
Le deuxième argument est l'objet sur lequel l'action est effectuée, par exemple, un objet Post.
Le troisième argument est le message d'erreur à afficher si l'accès est refusé.

Ainsi, lorsque l'utilisateur accède à l'action edit dans le contrôleur, le "voter" que nous avons défini précédemment est appelé pour déterminer si l'utilisateur a le droit d'éditer le post spécifié. Si l'accès est refusé, une exception `AccessDeniedException` est générée, et le message d'erreur spécifié est affiché. Si l'accès est autorisé, le code à l'intérieur du bloc suivant le `denyAccessUnlessGranted` est exécuté.
