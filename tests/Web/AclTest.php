<?php

namespace App\Tests\Web;

use App\Repository\UserRepository;
use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AclTest extends WebTestCase
{
    public function testHome(): void
    {
        // on crée un instance d'un navigateur
        $client = static::createClient();
        // on envoie une requête
        $crawler = $client->request('GET', '/');

        // on teste si la route répond bien
        $this->assertResponseIsSuccessful();
        // on teste si le h1 de la page contient ce que le client a demandé
        $this->assertSelectorTextContains('h1', 'Films, séries TV et popcorn en illimité.');
    }

    /**
     * @dataProvider urlNotConnectedProvider
     */
    public function testNotConnected($url, $codeRetour): void
    {
        // on crée un instance d'un navigateur
        $client = static::createClient();
        // on envoie une requête
        $crawler = $client->request('GET', $url);

        $this->assertResponseStatusCodeSame($codeRetour);
    }

    // Utilisation d'un dataprovider
    // REFER : https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#data-providers
    public static function urlNotConnectedProvider(): array
    {
        return [
            ['/', 200],
            ['/movies', 200],
            ['/show/Chinatown', 200],
            ['/review/42', 302]
        ];
    }

    // Utilisation d'un dataprovider
    // REFER : https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#data-providers
    public static function urlConnectedProvider(): array
    {
        return [
            ['/',                       200, 'GET', 'manager@manager.com'],
            ['/movies',                 200, 'GET', 'manager@manager.com'],
            ['/show/Chinatown',         200, 'GET', 'manager@manager.com'],
            ['/review/42',              200, 'GET', 'manager@manager.com'],
            ['/back/movie',             301, 'GET', 'manager@manager.com'],
            ['/back/movie/new',         403, 'GET', 'user@user.com'],
            ['/back/movie/new',         403, 'GET', 'manager@manager.com'],
            ['/back/movie/new',         200, 'GET', 'admin@admin.com'],
        ];
    }

    // REFER : https://symfony.com/blog/new-in-symfony-5-1-simpler-login-in-tests
    /**
     * @dataProvider urlConnectedProvider
     */
    public function testStatusCodeConnected($url, $expectedStatusCode, $method, $user): void
    {
        // création d'un faux navigateur
        $client = static::createClient();

        // connecter un utilisateur
        // get or create the user somehow (e.g. creating some users only
        // for tests while loading the test fixtures)
        // On n'est pas dans un service de Symfont, on ne peut donc pas injecter de dépendances
        // On doit donc récupérer le conteneur de service
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($user);

        $client->loginUser($testUser);

        // Exécution d'une requête
        $crawler = $client->request($method, $url);

        $this->assertResponseStatusCodeSame($expectedStatusCode);
    }

    // on peut tout tester
    // par exemple pour les formulaires
    // REFER : https://symfony.com/doc/6.4/form/unit_testing.html
    // REFER : https://symfony.com/doc/6.4/testing.html#submitting-forms

    // Tester Ajout d'une critique en POST

    /**
     * @dataProvider urlReview
     */
    public function testAddReview($id, $userName, $returnGet, $returnPost)
    {
        // on instancie un client
        $client = static::createClient();

        // connecter un utilisateur
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user@user.com');
        $client->loginUser($testUser);

        // on appelle la page d'ajout d'une revue
        $crawler = $client->request('GET', '/review/'.$id);

        // on vérifie qu'on est bien sur la page du formulaire d'ajout
        $this->assertResponseStatusCodeSame($returnGet);

        // on rempli le formulaire
        $crawler = $client->submitForm('Ajouter', [
            'review[username]'      => $userName,
            'review[email]'         => 'Patrick@patrick.com',
            'review[content]'       => 'La revue de Patrick',
            'review[rating]'        => '5',
            'review[reactions]'     => ['smile', 'cry'],
            'review[watchedAt]'     => '2024-01-26 10:19:00',
        ]);

        // on fois soumis, on attend un retour 302
        $this->assertResponseStatusCodeSame($returnPost);

    }

    public static function urlReview()
    {
        return [
            ['32', 'Patrick', 200, 302],
            ['666', 'Patrick', 404, 302],
        ];
    }
}
