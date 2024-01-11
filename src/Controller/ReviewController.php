<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    #[Route('/review/{id<\d+>}', name: 'front_review_new')]
    public function new(Movie $movie, Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Review;
        $review->setWatchedAt(new \DateTimeImmutable);
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setMovie($movie);

            $entityManager->persist($review);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'La critique a été ajoutée au film.'
            );


            return $this->redirectToRoute('front_main_show', ['id' => $movie->getId()]);
        }

        return $this->render('review/new.html.twig', [
            'movie' => $movie,
            'form'  => $form,
        ]);
    }
}
