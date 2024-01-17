<?php

namespace App\Controller\Back;

use App\Entity\Movie;
use App\Entity\Season;
use App\Form\SeasonType;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/back/season')]
class SeasonController extends AbstractController
{
    #[Route('/{id<\d+>}', name: 'app_back_season_index', methods: ['GET'])]
    public function index(Movie $movie = null, SeasonRepository $seasonRepository): Response
    {
        if(!$movie)
        {
            $this->addFlash(
                'warning','Le film demandé n\'existe pas.'
            );
            return $this->redirectToRoute('app_back_movie_index');
        }
        return $this->render('back/season/index.html.twig', [
            'seasons'   => $seasonRepository->findByMovie($movie, ['number'=> 'ASC']),
            'movie'     => $movie,
        ]);
    }

    #[Route('/new/{id<\d+>}', name: 'app_back_season_new', methods: ['GET', 'POST'])]
    public function new(Movie $movie = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$movie)
        {
            $this->addFlash(
                'warning','Le film demandé n\'existe pas.'
            );
            return $this->redirectToRoute('app_back_movie_index');
        }
        $season = new Season();
        $season->setMovie($movie);
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($season);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Une saison a été ajouté à <strong>' . $movie->getTitle() . '</strong>.'
            );

            return $this->redirectToRoute('app_back_season_index', ['id'=>$movie->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/season/new.html.twig', [
            'season'    => $season,
            'form'      => $form,
            'movie'     => $movie,
        ]);
    }

    #[Route('/{id<\d+>}/show', name: 'app_back_season_show', methods: ['GET'])]
    public function show(Season $season): Response
    {
        $movie = $season->getMovie();
        return $this->render('back/season/show.html.twig', [
            'season'    => $season,
            'movie'     => $movie,
        ]);
    }

    // REFER : https://symfony.com/doc/6.4/doctrine.html#mapentity-options
    #[Route('/{id<\d+>}/edit/{idSeason<\d+>}', name: 'app_back_season_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        // #[MapEntity(id: 'idMovie')]
        Movie $movie = null,
        #[MapEntity(id: 'idSeason')]
        Season $season, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if(!$movie)
        {
            $this->addFlash(
                'warning','Le film demandé n\'existe pas.'
            );
            return $this->redirectToRoute('app_back_movie_index');
        }
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Une saison a été modifiée sur <strong>' . $movie->getTitle() . '</strong>.'
            );

            return $this->redirectToRoute('app_back_season_index', ['id'=>$movie->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/season/edit.html.twig', [
            'season'    => $season,
            'form'      => $form,
            'movie'     => $movie,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_back_season_delete', methods: ['POST'])]
    public function delete(Request $request, Season $season, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$season->getId(), $request->request->get('_token'))) {
            $entityManager->remove($season);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Une saison a été supprimée sur <strong>' . $season->getMovie()->getTitle() . '</strong>.'
            );
        }

        return $this->redirectToRoute('app_back_season_index', ['id'=>$season->getMovie()->getId()], Response::HTTP_SEE_OTHER);
    }
}
