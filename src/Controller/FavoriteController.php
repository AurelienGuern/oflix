<?php

namespace App\Controller;

use App\Model\MovieModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favorites', name: 'front_favorites_index')]
    public function index(): Response
    {
        // On doit récupérer la liste des films
        $result = MovieModel::index();
        // dd($movies);

        return $this->render('favorites/index.html.twig', []);
    }
}
