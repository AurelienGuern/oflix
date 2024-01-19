<?php

namespace App\Command;

use App\Repository\MovieRepository;
use App\Service\OmdbApi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'movies:poster',
    description: 'Ajouter l\'affiche du film en fonction de son titre',
)]
class MoviesPosterCommand extends Command
{
    public function __construct(
        private MovieRepository $movieRepository,
        private OmdbApi $omdbApi,
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // on récupère tous les films
        $movies = $this->movieRepository->findAll();
        // pour chaque film on récupère le poster s'il existe
        foreach ($movies as $movie) {
            $poster = $this->omdbApi->fetchPoster($movie->getTitle());
            // si le poster existe on modifie $movie, sinon on laisse tel quel
            if ($poster != null) {
                $movie->setPoster($poster);
                $this->entityManager->persist($movie);
                $io->success($movie->getTitle() . ' : affiche mise à jour.');
            } else {
                $io->warning($movie->getTitle() . ' n\'a pas pu être mis à jour.');
            }
            
        }
        // on sauvegarde en base de donnée
        $this->entityManager->flush();

        $io->success('La mise à jour des affiches est terminée.');

        return Command::SUCCESS;
    }
}
