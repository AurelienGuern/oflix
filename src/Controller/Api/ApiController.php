<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api/movies', name: 'api_movies_get', methods: ['GET'])]
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        $movies = $movieRepository->findAll();
        return $this->json($movies, 200, [], ['groups' => 'get_collection']);
    }

    #[Route('/api/movies/{id<\d+>}', name: 'api_movies_get_item', methods: ['GET'])]
    public function getItem(Movie $movie): JsonResponse
    {
        return $this->json($movie, 200, [], ['groups' => 'get_item']);
    }

    #[Route('/api/movies/random', name: 'api_movies_get_random', methods: ['GET'])]
    public function getRandom(MovieRepository $movieRepository): JsonResponse
    {
        $movies = $movieRepository->findAll();
        shuffle($movies);
        // on prend le premier élément
        $randomMovie = $movies[0];
        return $this->json($randomMovie, 200, [], ['groups' => 'get_random']);
    }

    #[Route('/api/genres', name: 'api_movies_get_genres', methods: ['GET'])]
    public function getGenres(GenreRepository $genreRepository): JsonResponse
    {
        $genres = $genreRepository->findAll();
        return $this->json($genres, 200, [], ['groups' => 'get_genres']);
    }

    #[Route('/api/genres/{id<\d+>}/movies', name: 'api_movies_get_genre', methods: ['GET'])]
    public function getOneGenre(Genre $genre): JsonResponse
    {
        $movies = $genre->getMovies();
        return $this->json($movies, 200, [], ['groups' => 'get_genre']);
    }
}
