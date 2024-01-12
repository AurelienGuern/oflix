<?php
// Fichier : FavoritesController.php | Date: 2024-01-01 | Auteur: Patrick SUFFREN

namespace App\Controller\Front;

use App\Model\MovieModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/favorites', name: 'front_favorites_')]
class FavoritesController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(Request $request): Response
    {
        // on récupère la liste des favoris
        // récupération de la liste actuelle des favoris
        // $session = $request->getSession();
        // $favorites = $session->get('favorites', []);

        // rendu inutile par l'utilisation de app.session.get('favorites') dans le twig

        return $this->render('front/favorites/index.html.twig', [
            'controller_name' => 'FavoritesController',
            // 'favorites'         => $favorites,
        ]);
    }

    #[Route('/add/{id<\d+>}', name: 'add', methods: ['POST'])]
    public function add(int $id, Request $request): Response
    {
        // récupération du film à mettre en favoris
        $movie = MovieModel::getMovieById($id);
        if ($movie === null) {
            throw $this->createNotFoundException("Le film demandé n'existe pas");
        }

        // récupération de la liste actuelle des favoris
        $session = $request->getSession();
        $favorites = $session->get('favorites', []);
        // on rajoute le film demandé
        // l'utilisation de array_key_exists garanti l'unicité du favoris
        if (!array_key_exists($id, $favorites)) {
            $favorites[$id] = $movie;
            $session->set('favorites', $favorites);
            // on prépare un message flash
            // REFER : https://symfony.com/doc/current/session.html#flash-messages


            $this->addFlash(
                'success',
                '<strong>' . $movie['title'] . '</strong> a été ajouté à votre liste de favoris.'
            );
        } else {
            $this->addFlash(
                'warning',
                '<strong>' . $movie['title'] . '</strong> fait déjà partie de votre liste de favoris.'
            );
        }
        return $this->redirectToRoute('front_favorites_list', [
            'controller_name'   => 'FavoritesController',
            // 'favorites'         => $favorites,
        ]);
    }

    #[Route('/remove/{id<\d+>}', name: 'remove', methods: ['POST'])]
    public function remove(int $id, Request $request): Response
    {
        // récupération du film à supprimer des favoris
        $movie = MovieModel::getMovieById($id);
        if ($movie === null) {
            throw $this->createNotFoundException("Le film demandé n'existe pas");
        }

        // récupération de la liste actuelle des favoris
        $session = $request->getSession();
        $favorites = $session->get('favorites', []);

        // si l'entrée $id existe, on la supprime

        if (array_key_exists($id, $favorites)) {
            unset($favorites[$id]);
            $session->set('favorites', $favorites);

            $this->addFlash(
                'success',
                '<strong>' . $movie['title'] . '</strong> a été supprimé de votre liste de favoris.'
            );
        }

        return $this->render('front/favorites/index.html.twig', [
            'controller_name' => 'FavoritesController',
        ]);
    }

    #[Route('/empty', name: 'empty', methods: ['GET'])]
    public function empty(Request $request): Response
    {
        // récupération de la liste actuelle des favoris
        $session = $request->getSession();
        // on supprime les favoris stockés
        $session->remove('favorites');
        $this->addFlash(
            'success',
            ' Votre liste de favoris a été vidée.'
        );
        return $this->render('front/favorites/index.html.twig', [
            'controller_name' => 'FavoritesController',
        ]);
    }
}
