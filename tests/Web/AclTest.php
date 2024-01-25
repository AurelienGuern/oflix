<?php

namespace App\Tests\Web;

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
            ['/', 200],
            ['/movies', 200],
            ['/show/Chinatown', 200],
            ['/review/42', 200]
        ];
    }
}
