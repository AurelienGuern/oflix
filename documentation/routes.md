# Routes de l'application

| URL          | Nom                     | Méthode HTTP | Contrôleur            | Méthode    | Titre HTML           | Commentaire                                       |
| ------------ | ----------------------- | ------------ | --------------------- | ---------- | -------------------- | ------------------------------------------------- |
| `/`          | `front_main_home`       | `GET`        | `MainController`      | `home`     | Bienvenue sur O'flix | Page d'accueil triée par release_date descendante |
| `/show/{id}` | `front_main_show`       | `GET`        | `MainController`      | `show`     | Film sur O'Flix      | Page de détail d'un film                          |
| `/movies`    | `front_main_index`      | `GET`        | `MainController`      | `index`    | Films sur O'Flix     | Page des films triée par titre ascendant          |
| `/favorites` | `front_favorites_index` | `GET`        | `FavoritesController` | `index`    | Mes favoris          | Page de mes favoris                               |
| `/switch`    | `front_main_switcher`   | `GET`        | `MainController`      | `switcher` |                      | Changement de thème                               |
