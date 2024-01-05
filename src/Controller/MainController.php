<?php

namespace App\Controller;

// use App\Model\MovieModel;

use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * Affiche les films par ordre de sortie décroissant
     * 
     * @return Response 
     */
    #[Route('/', name: 'front_main_home')]
    public function home(MovieRepository $movieRepository, GenreRepository $genreRepository): Response
    {
    
        return $this->render('main/home.html.twig', [
            'movies' => $movieRepository->findAll(),
            'genres' => $genreRepository->findAll()
        ]);
    }

    /**
     * Affiche les films par ordre alphabétique croissant
     *
     * @return Response
     */
    #[Route('/movies', name: 'front_main_index')]
    public function index(MovieRepository $movieRepository, GenreRepository $genreRepository): Response
    {
        // On doit récupérer la liste des films
        
        return $this->render('main/home.html.twig', [
            'movies' => $movieRepository->findAll(),
            'genres' => $genreRepository->findAll()
        ]);
    }

    /**
     * Affiche un fil donné par son identifiant
     * @return Response
     */
    #[Route('/show/{id<\d+>}', name: 'front_main_show')]
    public function show(Movie $movie, Genre $genre, Casting $casting): Response
    {
        // On doit récupérer le film avec $id
      
        if ($movie === null) {
            // REFER : https://symfony.com/doc/current/controller.html#managing-errors-and-404-pages
            // On met un flash message pour informer de l'erreur
            $this->addFlash(
                'warning',
                "Ce film n'existe pas dans la base. Voici les derniers films proposés"
            );

            return $this->redirectToRoute('front_main_home');
        }

        return $this->render('main/show.html.twig', [
            'movie' => $movie,
            'genre' => $genre,
            'casting' => $casting
        ]);
    }
    #[Route('/switch', name: 'front_main_switcher')]
    // utilisation de l'injection de dépendance de Symfony
    // REFER : https://grafikart.fr/tutoriels/injection-571
    // REFER : https://blog.eleven-labs.com/fr/injection-des-dependances/
    public function switcher(SessionInterface $session): Response
    {
        // cette fonction récupère le thème actuel
        // REFER : https://symfony.com/doc/current/session.html#session-attributes
        // gets an attribute by name
        $theme = $session->get('theme');

        // et le permute dans l'autre thème netflix <-> allocine
        if ($theme == 'allocine') {
            $session->set('theme', 'netflix');
        } else {
            $session->set('theme', 'allocine');
        }

        $this->addFlash(
            'success',
            'votre thème a été changé !'
        );
        return $this->redirectToRoute(('front_main_home'));
    }

    #[Route('/genres', name: 'app_genres')]
    public function genres(GenreRepository $genreRepository): Response
    {
        return $this->render('genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
        ]);
    }

    #[Route('/genre/{id}', name: 'show_genre')]
    public function genre(GenreRepository $genreRepository, Genre $genre): Response
    {
    
        return $this->render('genre/show.html.twig', [
            'genre' => $genre,
            'movies' => $genre->getMovie()
        ]);
    }
}
