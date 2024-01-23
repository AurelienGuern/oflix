<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// REFER : https://symfony.com/doc/6.4/controller.html#returning-json-response
class ApiController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les films avec quelques informations de base
     *
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    #[Route('/api/movies', name: 'api_movies_get', methods: ['GET'])]
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        $movies = $movieRepository->findAll();
        return $this->json($movies,200,[],['groups' => 'get_collection']);
    }

    /**
     * Renvoi des détails d'un film donné pour affichage de ce film
     *
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    #[Route('/api/movies/{id<\d+>}', name: 'api_movies_get_item', methods: ['GET'])]
    public function getItem(Movie $movie): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        
        return $this->json($movie,200,[],['groups' => 'get_item']);
    }




     #[Route('/api/movies/random}', name: 'api_movies_get_item', methods: ['GET'])]
    public function getRandom(Movie $movie): JsonResponse
    {
        
        return $this->json($movie,200,[],['groups' => 'get_random']);
    }

    #[Route('/api/genres}', name: 'api_movies_get_item', methods: ['GET'])]
    public function getGenres(GenreRepository $genreRepository): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        
        return $this->json($genreRepository->findAll(),200,[],['groups' => 'get_genres']);
    }

    #[Route('/api/genres/{id<\d+>/movies}', name: 'api_movies_get_item', methods: ['GET'])]
    public function getOneGenre(Genre $genre): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        
        return $this->json($genre,200,[],['groups' => 'get_genre']);
    }
}
