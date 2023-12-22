<?php

namespace App\Controller;

use App\Model\MovieModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favorites', name: 'front_favorites_index')]
    public function index(SessionInterface $session): Response
    {
        // Récupérer tous les films
        $allMovies = MovieModel::getMovies();
    
        // Récupérer les films favoris à partir de la session
        $favoriteMoviesIds = MovieModel::getFavoriteMovies($session);
    
        // Filtrer les films pour afficher uniquement les favoris
        $favoriteMovies = array_filter($allMovies, function ($movie) use ($favoriteMoviesIds) {
            return in_array($movie['id'], $favoriteMoviesIds);
        });
    
        return $this->render('favorites/index.html.twig', [
            'movies' => $favoriteMovies,
        ]);
    }
    

    #[Route('/favorites/add/{id<\d+>}', name: 'front_favorites_add')]
public function add(int $id, SessionInterface $session): Response
{
    // Ajoute l'ID du film aux favoris dans la session
    $favoriteMovies = $session->get('favorite_movies', []);
    
    // Vérifie si le film est déjà dans les favoris
    if (!in_array($id, $favoriteMovies)) {
        $favoriteMovies[] = $id;
        $session->set('favorite_movies', $favoriteMovies);

        $this->addFlash(
            'success',
            'Le film a été ajouté à vos favoris !'
        );
    } else {
        $this->addFlash(
            'info',
            'Le film est déjà dans vos favoris.'
        );
    }

    return $this->redirectToRoute('front_favorites_index');
}



    #[Route('/favorites/remove/{id<\d+>}', name: 'front_favorites_remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $favoriteMovies = $session->get('favorite_movies', []);
    
        // Recherche l'index du film dans le tableau des favoris
        $index = array_search($id, $favoriteMovies);
    
        if ($index !== false) {
            // Si le film est trouvé dans les favoris, supprimez-le du tableau
            unset($favoriteMovies[$index]);
            $session->set('favorite_movies', array_values($favoriteMovies));
    
            $this->addFlash(
                'alert',
                'Le film a été supprimé de vos favoris !'
            );
        } else {
            $this->addFlash(
                'info',
                'Le film ne faisait pas partie de vos favoris.'
            );
        }
    
        return $this->redirectToRoute('front_favorites_index');
    }

    #[Route('/favorites/remove/all', name: 'front_favorites_empty')]
    public function empty(SessionInterface $session): Response
    {
        // Supprime complètement la clé des favoris de la session
        $session->remove('favorite_movies');
    
        $this->addFlash(
            'alert',
            'Tous les favoris ont été supprimés !'
        );
    
        return $this->redirectToRoute('front_main_home');
    }
    
}