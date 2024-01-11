<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use App\Entity\Casting;
use Bluemmb\Faker\PicsumPhotosProvider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OflixProvider;

class AppFixtures extends Fixture
{
    private $genres  = [];
    private $persons = [];

    public function load(ObjectManager $manager): void
    {
        // create a French faker
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Character($faker));
        $faker->addProvider(new PicsumPhotosProvider($faker));
        $faker->addProvider(new OflixProvider);

        // création de 20 genres
        for ($i = 0; $i < 20; $i++) {
            $genre = new Genre;
            $genre->setName($faker->unique()->movieGenre());
            $manager->persist($genre);
            $this->genres[] = $genre;
        }

        // on crée des personnes
        for ($i = 0; $i < 190; $i++) {
            // on récupère un acteur et on éclate en deux
            $actor = explode(' ', $faker->unique()->actor(), 2);
            $person = new Person;
            $person->setFirstname($actor[0]);
            $person->setLastname($actor[1]);
            $manager->persist($person);
            $this->persons[] = $person;
        }

        // Movie : Film

        for ($i = 0; $i < 50; $i++) {
            $movie = new Movie;
            // si un movie est une série alors il y a des saison
            if ($faker->boolean()) {
                // c'est un film
                $movie->setTitle($faker->unique()->movie());
                $movie->setType('Film');
                $movie->setDuration(random_int(80, 330));
            } else {
                // c'est une série
                $movie->setTitle($faker->unique()->tvShow());
                $movie->setType('Série');
                $movie->setDuration(random_int(25, 60));
                // il y a aussi des saisons
                for ($j = 1; $j < random_int(2, 12); $j++) {
                    $season = new Season;
                    $season->setNumber($j);
                    $season->setEpisodeNumber(random_int(6, 12));
                    $season->setMovie($movie);
                    $manager->persist($season);
                }
            }

            $movie->setReleaseDate(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween()));
            $movie->setSummary($faker->realText(60));
            $movie->setSynopsis($faker->sentence(4));
            $movie->setPoster($faker->imageUrl(200, 300, true));
            $movie->setRating(rand(1, 5));

            // on associe entre 0 et 4 genres à un movie
            for ($j = 0; $j < random_int(0, 5); $j++) {
                $movie->addGenre($faker->unique()->randomElement($this->genres));
            }

            // on associe les personnes et les films avec Casting
            // jusqu'à 10 acteurs par movie
            // avec le creditOrder dans le désordre
            $orders = range(0, random_int(0, 10));
            shuffle($orders);
            if (count($orders) != 1) {
                foreach ($orders as $order) {
                    $casting = new Casting;
                    $casting->setMovie($movie);
                    $casting->setPerson($this->persons[random_int(0, count($this->persons) - 1)]);
                    $casting->setCreditOrder($order + 1);
                    $casting->setRole($faker->character());
                    $manager->persist($casting);
                }
            }

            $manager->persist($movie);
        }
        $manager->flush();
    }
}
