<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Casting;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
$movie = null;
$person = null;

        // création de 20 acteurs
        for ($i = 1; $i < 21; $i++) {
            $person = new Person();
            $person->setFirstname('Prénom' . $i);
            $person->setLastname('Nom' . $i);
            $manager->persist($person);
        }

        for ($i = 1; $i < 21; $i++) {
            $genre = new Genre();
            $genre->setName('nom de genre ' . $i);
            $manager->persist($genre);
        }

        // création de 40 movie
        for ($i = 1; $i < 41; $i++) {
            $post = new Movie();
            $post->setTitle('Titre ' . $i);
            $post->setType(rand(0, 1) ? 'Movie' : 'Série');
            $post->setSummary('Résuméééééééééé ' . $i);
            $post->setSynopsis('Synops ' . $i);
            $post->setPoster('https://1.bp.blogspot.com/-iCnFX7eWVjs/XR9NQutHXcI/AAAAAAAAJ9k/ISWH3UXgJF8QJdsV6P9wh3agzOwOF_aYgCLcBGAs/s1600/cat-1285634_1920.png');
            $post->setRating(rand(1, 50) / 10 + 1);
            $post->setReleaseDate(new \DateTimeImmutable());
            $post->setDuration(rand(1, 200));

            $manager->persist($post);
        }

        for ($i = 1; $i < 25; $i++) {
            $post = new Casting();
            $post->setMovie($movie);
            $post->setPerson($person);
            $post->setRole('je possède un rôle');
            $post->setCreditOrder(rand(1, 10));
           
            $manager->persist($post);
        }

    
        $manager->flush();
    }
}
