<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// REFER : https://symfony.com/doc/6.4/controller.html#returning-json-response
class ApiGenreController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les films avec quelques informations de base
     *
     * @param GenreRepository $genreRepository
     * @return JsonResponse
     */
    #[Route('/api/genres', name: 'api_genres_get', methods: ['GET'])]
    public function getCollection(GenreRepository $genreRepository): JsonResponse
    {
        // cette méthode met à disposition tous les genres de la base
        $genres = $genreRepository->findAll();
        return $this->json($genres,200,[],['groups' => 'get_genres_collection']);
    }

    // /**
    //  * Renvoi films d'un genre donné 
    //  *
    //  * @param Genre $genre
    //  * @return JsonResponse
    //  */
    #[Route('/api/genres/{id<\d+>}/movies', name: 'api_genres_item_movies', methods: ['GET'])]
    public function getGenreGetMovies(Genre $genre): JsonResponse
    {
        // cette méthode met à disposition la liste des films d'un genre donné
        return $this->json($genre,200,[],['groups' => 'get_genre_item_movies']);
    }
}
