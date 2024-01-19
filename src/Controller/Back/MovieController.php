<?php

namespace App\Controller\Back;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use App\Service\MySlugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'app_back_movie_index', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('back/movie/index.html.twig', [
            'movies' => $movieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_movie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MySlugger $slugger): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie->setSlug($slugger->slugify($movie->getTitle()));
            $entityManager->persist($movie);
            $entityManager->flush();

            // on prépare un message flash
            // REFER : https://symfony.com/doc/current/session.html#flash-messages
            $this->addFlash(
                'success',
                '<strong>' . $movie->getTitle() . '</strong> a été ajouté à votre base.'
            );

            return $this->redirectToRoute('app_back_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/movie/new.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_back_movie_show', methods: ['GET'])]
    public function show(Movie $movie): Response
    {
        return $this->render('back/movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/{id<\d+>}/edit', name: 'app_back_movie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Movie $movie, EntityManagerInterface $entityManager, MySlugger $slugger): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie->setSlug($slugger->slugify($movie->getTitle()));
            $entityManager->flush();

            // on prépare un message flash
            // REFER : https://symfony.com/doc/current/session.html#flash-messages
            $this->addFlash(
                'success',
                '<strong>' . $movie->getTitle() . '</strong> a été modifié.'
            );

            return $this->redirectToRoute('app_back_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_back_movie_delete', methods: ['POST'])]
    public function delete(Request $request, Movie $movie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($movie);
            $entityManager->flush();

            // on prépare un message flash
            // REFER : https://symfony.com/doc/current/session.html#flash-messages
            $this->addFlash(
                'success',
                '<strong>' . $movie->getTitle() . '</strong> a été supprimé.'
            );
        }

        return $this->redirectToRoute('app_back_movie_index', [], Response::HTTP_SEE_OTHER);
    }
}
