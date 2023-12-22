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
        $movies = MovieModel::getFavoriteMovies($session);
        // dd($movies);
        // tri des $movies par ordre de sortie décroissant
        // REFER : https://www.php.net/manual/fr/function.usort
       
        return $this->render('favorites/index.html.twig', [
            'movies' => $movies,
        ]);
    
       
    }

    #[Route('/favorites/add/{id<\d+>}', name: 'front_favorites_add')]
    public function add(int $id, SessionInterface $session): Response
{
    $movie = MovieModel::getMovieById($id);
    $favoriteMovies = $session->get('favorite_movies', []);

    // Vérifie si le film n'est pas déjà dans les favoris
    if (!in_array($movie, $favoriteMovies)) {
        // Ajoute le film à la liste des favoris
        $favoriteMovies[] = $movie;
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
        $movie = MovieModel::getMovieById($id);
        $movie = $session->set('favorite', 'no');

        $this->addFlash(
            'alert',
            'a été tej de vos favoris !'
        );
        return $this->redirectToRoute(('front_favorites_index'));
    }
}






// $this->addFlash('danger', 
// 'a été supprimé de vos favoris !');

// return $this->redirectToRoute(('front_favorites_index'));
// }