<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieTestController extends AbstractController
{
    #[Route('/movie/test', name: 'app_movie_test_browse')]
    public function browse(MovieRepository $movieRepository): Response
    {
        // l'objet de browse est d'afficher l'ensemble des données de l'entité Movie
        // on récupère toutes les movies
        $movies = $movieRepository->findAll();
        // on obtient un tableau de movie[]
        dd($movies);
        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/add', name: 'app_movie_test_add')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        // l'objet de add est d'ajouter un film à la base
        $movie = new Movie;
        $movie->setTitle('Apocalypse Now');
        $movie->setReleaseDate(new \DateTimeImmutable('26-09-1979'));
        $movie->setDuration(182);
        $movie->setSummary("Saïgon, le jeune capitaine Willard doit éliminer le colonel Kurtz");
        $movie->setSynopsis("Cloîtré ");
        $movie->setPoster("http://4everstatic.com/images/850xX/art/film-et-serie/apocalypse-now-181365.jpg");
        $movie->setRating("4.8");
        $movie->setType("Film");

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($movie);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}', name: 'app_movie_test_read')]
    public function read(Movie $movie = null): Response
    {
        // l'objet de browse est d'afficher un Movie donné
        // on récupère le movie
        // $movie = $movieRepository->find($id);
        // on obtient un movie

        // on peut traiter manuellement l'absence du film en $id
        if ($movie === null) {
            throw $this->createNotFoundException("Désolé ce film n'est pas encore dans notre catalogue");
        }
        dd($movie);
        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}/edit', name: 'app_movie_test_edit')]
    public function edit(Movie $movie, EntityManagerInterface $entityManager): Response
    {
        // l'objet de edit est de mofifier un film
        $movie->setDuration(245);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        // A noter : $em->persist() pas utile ici car récupéré via Doctrine
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}/delete', name: 'app_movie_test_delete')]
    public function delete(Movie $movie, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($movie);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        // A noter : $em->persist() pas utile ici car récupéré via Doctrine
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }
}
