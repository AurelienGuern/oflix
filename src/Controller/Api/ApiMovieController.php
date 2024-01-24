<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

// REFER : https://symfony.com/doc/6.4/controller.html#returning-json-response
#[Route('/api/movies', name: 'api_movies_')]
class ApiMovieController extends AbstractController
{
    /**
     * Renvoi de la liste de tous les films avec quelques informations de base
     *
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    #[Route('/', name: 'get', methods: ['GET'])]
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        $movies = $movieRepository->findAll();
        return $this->json($movies,200,[],['groups' => 'get_movies_collection']);
    }

    /**
     * Renvoi des détails d'un film donné pour affichage de ce film
     *
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    #[Route('/{id<\d+>}', name: 'get_item', methods: ['GET'])]
    public function getItem(Movie $movie): JsonResponse
    {
        // cette méthode met à disposition le détail d'un film donné
        return $this->json($movie,200,[],['groups' => 'get_movie_item']);
    }

    // /**
    //  * Renvoi film au hasard
    //  *
    //  * @param Genre $genre
    //  * @return JsonResponse
    //  */
    #[Route('/random', name: 'random', methods: ['GET'])]
    public function getRandomMovie(MovieRepository $movieRepository): JsonResponse
    {
        $movie = $movieRepository->findOneByRandom();
        // cette méthode met à disposition la liste des films d'un genre donné
        return $this->json($movie,200,[],['groups' => 'get_movie_item']);
    }

    /**
     * Création d'un nouveau film
     *
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    #[Route('/', name: 'new', methods: ['POST'])]
    public function new(Request $request, SerializerInterface $serializer): JsonResponse
    {
        // Récupérer les informations JSON
        $json = $request->getContent();
        // Attention lors des tests avec Postman, il faut rajoute un '/' à la fin de l'URL en POST
        // désérialisation du JSON pour obtenir un objet Movie
        // REFER : https://symfony.com/doc/6.4/serializer.html#serializer-context
        $movie = $serializer->deserialize($json, Movie::class, 'json');

        dd($movie);
        return $this->json($json,200,[],['groups' => 'get_movies_collection']);
    }
}
