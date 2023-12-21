<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    #[Route('/', name: 'front_main_home')]
    public function home() : Response
    {
        $response = new Response('Méthode Home de MainController', Response::HTTP_OK);

        return $response;
    }
}