# Pourqui utiliser une interface plutôt qu'une classe concrète en injection de dépendance

## Cas des Session

Dans Symfony, le typehint `SessionInterface` est généralement recommandé plutôt que `Session` en tant qu'argument pour plusieurs raisons, dont la principale est liée à la flexibilité et à la testabilité du code.

La principale différence entre les deux est que `Session` est une classe concrète, tandis que `SessionInterface` est une **interface**. Utiliser une **interface** plutôt qu'une classe concrète est <u>une bonne pratique en programmation orientée objet</u> car cela permet d'inverser la dépendance et de rendre le code plus modulaire et testable.

## Avantages de l'interface

En utilisant `SessionInterface`, vous déclarez que votre classe dépend d'une **interface** (un contrat) plutôt que d'une implémentation spécifique. Cela rend votre code moins dépendant d'une implémentation particulière et plus facile à tester, car vous pouvez fournir des mock objects ou des stubs lors des tests.

## Inconvénients de la classe concrète

Si vous utilisez directement la classe `Session`, vous êtes lié à une implémentation spécifique, ce qui peut rendre votre code plus difficile à tester et à maintenir à long terme. Si, à l'avenir, Symfony introduit une nouvelle implémentation de la session ou si vous souhaitez utiliser une implémentation personnalisée dans certains cas, vous devrez changer votre code partout où la classe `Session` est utilisée.

## Conclusion

En résumé, il est généralement recommandé d'utiliser des **interfaces** (`SessionInterface`, dans ce cas) plutôt que des classes concrètes (`Session`) chaque fois que c'est possible, car cela favorise la modularité, la flexibilité et la testabilité du code.