<?php
// Fichier : MainController.php | Date: 2024-01-01 | Auteur: Patrick SUFFREN

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Model\MovieModel;
use App\Repository\CastingRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Affiche les films par ordre de sortie décroissant
     * 
     * @return Response 
     */
    #[Route('/', name: 'front_main_home')]
    public function home(MovieRepository $movieRepository): Response
    {
        // On doit récupérer la liste des films
        // $movies = MovieModel::getMovies();
        // $movies = $movieRepository->findAll();
        // utilisation d'une requete personnalisée
        $movies = $movieRepository->findAllOrderByDateDescQB(5, 5);
        // dd($movies);
        // tri des $movies par ordre de sortie décroissant
        // REFER : https://www.php.net/manual/fr/function.usort
        // uasort($movies, function ($movie1, $movie2) {
        //     return $movie2->getReleaseDate() > $movie1->getReleaseDate();
        // });
        return $this->render('front/main/home.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * Affiche les films par ordre alphabétique croissant
     *
     * @return Response
     */
    #[Route('/movies', name: 'front_main_index')]
    #[Route('/search', name: 'front_main_search')]
    public function index(MovieRepository $movieRepository, Request $request): Response
    {
        // Récupération d'un éventuel critère de recherche
        $search = $request->query->get('search');

        // On doit récupérer la liste des films
        // $movies = MovieModel::getMovies();
        // utilisation d'une requête personnalisée
        // $movies = $movieRepository->findAllOrderByTitleAscDql();
        $movies = $movieRepository->findAllOrderByTitleAscQB($search);
        // dd($movies);
        // tri des $movies par ordre de alphabétique
        // REFER : https://www.php.net/manual/fr/function.usort
        // REFER : https://www.php.net/manual/fr/function.strcasecmp.php
        // uasort($movies, function ($movie1, $movie2) {
        //     return strcasecmp($movie1['title'], $movie2['title']);
        // });

        return $this->render('front/main/home.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * Affiche un fil donné par son identifiant
     * @return Response
     */
    #[Route('/show/{slug}', name: 'front_main_show')]
    public function show(Movie $movie = null, CastingRepository $castingRepository): Response
    {
        // On doit récupérer le film avec $id
        // $movie = MovieModel::getMovieById($id);
        if ($movie === null) {
            // REFER : https://symfony.com/doc/current/controller.html#managing-errors-and-404-pages
            // throw $this->createNotFoundException('Ce film n\'existe pas');
            // le client demande dans ce cas (essai d'accès à un film inexistant) de renvoyer vers la home avec un message d'erreur
            // REFER : https://symfony.com/doc/6.4/session.html#flash-messages
            // on met en place un flas message pour informer l'utilisateur
            $this->addFlash(
                'info',
                'Ce film n\'existe pas dans la base, voici les derniers films proposés'
            );
            
            // REFER : https://symfony.com/doc/current/controller.html#redirecting
            return $this->redirectToRoute('front_main_home');
        }
        $castings = $castingRepository->findCastingsForMovie($movie);

        return $this->render('front/main/show.html.twig', [
            'movie'     => $movie,
        ]);
    }

    /**
     * switcher le theme en utilisant la session
     *
     * @return Response
     */
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
        if ($theme === 'allocine') {
            $session->set('theme', 'netflix');
        } else {
            $session->set('theme', 'allocine');
        }

        $this->addFlash('success', 'Votre thème a bien été modifié !');

        // redirection vers la home
        // REFER : https://symfony.com/doc/current/controller.html#redirecting
        return $this->redirectToRoute('front_main_home');
    }
}
