<?php

namespace App\Controller;

use App\Model\MovieModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'front_main_home')]
    public function home() : Response
    {
        // On doit récupérer la liste des films
        $movies = MovieModel::getMovies();
        // dd($movies);

        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }
}