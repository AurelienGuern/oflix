<?php

namespace App\EventSubscriber;

use App\Repository\MovieRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class RandomMovieSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MovieRepository $movieRepository,
        private Environment $twig
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $movies = $this->movieRepository->findAll();
        // shuffle permet de mélanger le tableau au hasard, il mélange le tableau sur lui même
        shuffle($movies);
        // on prend le premier élément
        $randomMovie = $movies[0];

        // AUTRE METHODE
        // $randomMovie = $this->movieRepository->findOneByRandom();

        // on met le $randomMovie à disposition des twigs
        $this->twig->addGlobal('randomMovie', $randomMovie);
    }
}
