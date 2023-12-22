<?php

namespace App\Controller;

use App\Model\MovieModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    #[Route('/', name: 'front_main_home')]
    public function home(): Response
    {
        // On doit récupérer la liste des films
        $movies = MovieModel::getMovies();
        // dd($movies);
        // tri des $movies par ordre de sortie décroissant
        // REFER : https://www.php.net/manual/fr/function.usort
        usort($movies, function ($movie1, $movie2) {
            return $movie2['release_date'] - $movie1['release_date'];
        });
        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * Affiche les films par ordre alphabétique croissant
     *
     * @return Response
     */
    #[Route('/movies', name: 'front_main_index')]
    public function index(): Response
    {
        // On doit récupérer la liste des films
        $movies = MovieModel::getMovies();
        // dd($movies);
        // tri des $movies par ordre de alphabétique
        // REFER : https://www.php.net/manual/fr/function.usort
        // REFER : https://www.php.net/manual/fr/function.strcasecmp.php
        usort($movies, function ($movie1, $movie2) {
            return strcasecmp($movie1['title'], $movie2['title']);
        });

        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/show/{id}', name: 'front_main_show')]
    public function show($id): Response
    {

        $movie = MovieModel::getMovieById($id);


        return $this->render('main/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}
