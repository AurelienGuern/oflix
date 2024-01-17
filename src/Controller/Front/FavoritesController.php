<?php
// Fichier : FavoritesController.php | Date: 2024-01-01 | Auteur: Patrick SUFFREN

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Service\FavoritesManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/favorites', name: 'front_favorites_')]
class FavoritesController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        // Utilisation de app.session.get('favorites') dans le twig

        return $this->render('front/favorites/index.html.twig', []);
    }

    #[Route('/add/{id<\d+>}', name: 'add', methods: ['POST'])]
    public function add(FavoritesManager $favoritesManager, Movie $movie = null, Request $request): Response
    {
        // Vérification du film à mettre en favoris
        if ($movie === null) {
            throw $this->createNotFoundException("Le film demandé n'existe pas");
        }
        // on délègue toute la partie métier au service Favorites Manager
        if ($favoritesManager->add($movie)) {
            // on prépare un message flash
            // REFER : https://symfony.com/doc/current/session.html#flash-messages


            $this->addFlash(
                'success',
                '<strong>' . $movie->getTitle() . '</strong> a été ajouté à votre liste de favoris.'
            );
        } else {
            $this->addFlash(
                'warning',
                '<strong>' . $movie->getTitle() . '</strong> fait déjà partie de votre liste de favoris.'
            );
        }
        return $this->redirectToRoute('front_favorites_list', []);
    }

    #[Route('/remove/{id<\d+>}', name: 'remove', methods: ['POST'])]
    public function remove(FavoritesManager $favoritesManager, Movie $movie = null, Request $request): Response
    {
        // Vérification du film à supprimer des favoris
        if ($movie === null) {
            throw $this->createNotFoundException("Le film demandé n'existe pas");
        }

        // on délègue toute la partie métier au service Favorites Manager
        if ($favoritesManager->remove($movie)) {
            $this->addFlash(
                'success',
                '<strong>' . $movie->getTitle() . '</strong> a été supprimé de votre liste de favoris.'
            );
        }

        return $this->render('front/favorites/index.html.twig', []);
    }

    #[Route('/empty', name: 'empty', methods: ['GET'])]
    public function empty(FavoritesManager $favoritesManager,): Response
    {
        if ($favoritesManager->empty()) {
            $this->addFlash(
                'success',
                ' Votre liste de favoris a été vidée.'
            );
        } else {
            $this->addFlash(
                'danger',
                'La liste des favoris ne peut pas être vidée.'
            );
        }
        return $this->render('front/favorites/index.html.twig', [
            'controller_name' => 'FavoritesController',
        ]);
    }
}
