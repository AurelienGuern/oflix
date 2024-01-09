<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Casting;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    
    public function load(ObjectManager $manager): void
    {
        
$movie = null;
$person = null;

        // création de 20 acteurs
        for ($i = 1; $i < 21; $i++) {
            $person = new Person();
            $person->setFirstname($this->faker->actor());
            $person->setLastname(' ');
            $manager->persist($person);
        }

        for ($i = 1; $i < 21; $i++) {
            $genre = new Genre();
            $genre->setName($this->faker->movieGenre());
            $manager->persist($genre);
        }

        // création de 40 movie
        for ($i = 1; $i < 41; $i++) {
            $movie = new Movie();
            $movie->setTitle($this->faker->movie());
            $movie->setType(rand(0, 1) ? 'Movie' : 'Série');
            $movie->setSummary($this->faker->sentence(4));
            $movie->setSynopsis($this->faker->sentence(2));
            $movie->setPoster('https://1.bp.blogspot.com/-iCnFX7eWVjs/XR9NQutHXcI/AAAAAAAAJ9k/ISWH3UXgJF8QJdsV6P9wh3agzOwOF_aYgCLcBGAs/s1600/cat-1285634_1920.png');
            $movie->setRating(rand(1, 50) / 10 + 1);
            $movie->setReleaseDate(new \DateTimeImmutable());
            $movie->setDuration(rand(40, 200));
            $manager->persist($movie);
        }

        for ($i = 1; $i < 25; $i++) {
            $post = new Casting();
            $post->setMovie($movie);
            $post->setPerson($person);
            $post->setRole($this->faker->word());
            $post->setCreditOrder(rand(1, 10));
           
            $manager->persist($post);
        }

    
        $manager->flush();
    }
}
