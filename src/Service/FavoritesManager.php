<?php

namespace App\Service;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\RequestStack;

class FavoritesManager
{

    // private $request;
    // // injection de l'objet RequestStack via le controleur
    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }

    // REFER : https://www.php.net/manual/fr/language.oop5.decon.php#language.oop5.decon.constructor.promotion

    public function __construct(
        private RequestStack $requestStack,
        private bool $emptyEnabled)
    {
    }

    public function add(Movie $movie): bool
    {
        // on récupère la session
        $session = $this->requestStack->getCurrentRequest()->getSession();
        // on récupère les favoris de la session
        $favorites = $session->get('favorites', []);
        // on rajoute le film demandé
        // l'utilisation de array_key_exists garanti l'unicité du favoris
        if (!array_key_exists($movie->getId(), $favorites)) {
            $favorites[$movie->getId()] = $movie;
            $session->set('favorites', $favorites);
            return true;
        } else {
            return false;
        }
    }

    public function remove(Movie $movie): bool
    {
        // on récupère la session
        $session = $this->requestStack->getCurrentRequest()->getSession();
        // on récupère les favoris de la session
        $favorites = $session->get('favorites', []);

        // si l'entrée $movie existe, on la supprime

        if (array_key_exists($movie->getId(), $favorites)) {
            unset($favorites[$movie->getId()]);
            $session->set('favorites', $favorites);
            return true;
        } else {
            return false;
        }
    }

    public function empty(): bool
    {
        if(!$this->emptyEnabled)
        {
            return false;
        }
        // on récupère la session
        $session = $this->requestStack->getCurrentRequest()->getSession();
        // on supprime les favoris stockés
        $session->remove('favorites');
        return true;
    }
}
