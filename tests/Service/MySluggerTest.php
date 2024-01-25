<?php

namespace App\Tests\Service;

use App\Service\MySlugger;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class MySluggerTest extends TestCase
{
    public function testSlugify(): void
    {
        // on crée un tableau de tests avec l'élément envoyé et l'élément attendu et le isLower
        $tests = [
            ['Jo le Taxi', 'Jo-le-Taxi', false],
            ['Bonjour ça va bien', 'Bonjour-ca-va-bien', false],
            ['avec nombre 42 ?', 'avec-nombre-42', false],
            ['Jo le Taxi', 'jo-le-taxi', true],
            ['Bonjour ça va bien', 'bonjour-ca-va-bien', true],
            ['avec nombre 42 ?', 'avec-nombre-42', true],
        ];

        foreach ($tests as $test) {
            $slugger = new MySlugger(new AsciiSlugger(), $test[2]);
            $this->assertEquals($test[1],$slugger->slugify($test[0]));
        }
    }
    
}
