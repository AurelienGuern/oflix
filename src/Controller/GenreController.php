<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    #[Route('/genres', name: 'app_genre')]
    public function index(GenreRepository $genreRepository): Response
    {
        return $this->render('genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
        ]);
    }

    #[Route('/genre/{id}', name: 'app_genre')]
    public function show(GenreRepository $genreRepository, Genre $genre): Response
    {
        return $this->render('genre/show.html.twig', [
            'controller_name' => 'GenreController',
            'genre' => $genre,
            'movies' => $genre->getMovie()
        ]);
    }
}
