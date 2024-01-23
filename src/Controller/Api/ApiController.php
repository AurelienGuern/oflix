<?php

namespace App\Controller\Api;

use App\Repository\MovieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// REFER : https://symfony.com/doc/6.4/controller.html#returning-json-response
class ApiController extends AbstractController
{
    #[Route('/api/movies', name: 'api_movies_get')]
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        // cette méthode met à disposition tous les movies de la base
        $movies = $movieRepository->findAll();
        return $this->json($movies);
    }
}
