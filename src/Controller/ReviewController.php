<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    #[Route('/review/{id<\d+>}', name: 'front_review_new')]
    public function new(Movie $movie): Response
    {
        $review = new Review;
        $form = $this->createForm(ReviewType::class, $review);

        // TODO Gestion du formulaire

        return $this->render('review/new.html.twig', [
            'movie' => $movie,
            'form'  => $form,
        ]);
    }
}
