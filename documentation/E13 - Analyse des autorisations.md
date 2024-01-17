# ADMIN

```text
    app_back_movie_new         GET|POST      /back/movie/new                           
    app_back_movie_edit        GET|POST      /back/movie/{id}/edit                   
    app_back_movie_delete      POST          /back/movie/{id}                        
    app_back_season_new        GET|POST      /back/season/new/{id}              
    app_back_season_edit       GET|POST      /back/season/{idSeason}/edit/{id}  
    app_back_season_delete     POST          /back/season/{idSeason}/{id}  
```
Les pages de test sont uniquement là pour le développement. On les restreint à l'administrateur
```text
    movie_test                 ANY           /test/movie                              
    movie_test_browse          ANY           /test/movie/browse                       
    movie_test_show            ANY           /test/movie/{id}                         
    movie_test_update          ANY           /test/movie/update/{id}                  
    movie_test_add             ANY           /test/movie/add                          
    movie_test_delete          ANY           /test/movie/delete/{id} 
```                 

# MANAGER

```text
    app_back_movie_index       GET           /back/movie/  
    app_back_movie_show        GET           /back/movie/{id}  
    app_back_season_index      GET           /back/season/{id}  
    app_back_season_show       GET           /back/season/{idSeason}/{id}  
```

# USER

```text
    app_review_new             ANY           /review/{id}   
```
On limite les favoris à l'utilisateur connecté pour l'inciter à s'inscrire sur notre site
```text
    app_favorites_list         GET           /favorites                               
    app_favorites_add          POST          /favorites/add/{id}                      
    app_favorites_remove       GET           /favorites/remove/{id}                   
    app_favorites_empty        GET           /favorites/empty 
```

# ANONYME

```text
    app_login                  ANY           /login                                   
    app_logout                 ANY           /logout   
    app_main_home              GET           /                                        
    app_main_list              GET           /movies                                  
    app_main_search            GET           /search                                  
    app_main_show              GET           /show/{id}                               
    main_theme_switcher        ANY           /theme/toggle  
```

# Configurer access_control dans config/packages/security.yaml pour

- Front : Si user ANONYME : page d'accueil + fiche film seulement.
- Front : Si ROLE_USER : ajouter une critique sur un film.
- Admin : Si ROLE_MANAGER : accès aux pages de listes movie, genres etc. et pages show (si existantes).
- Admin : Sécuriser toutes les routes /add /edit /delete avec ROLE_ADMIN.
