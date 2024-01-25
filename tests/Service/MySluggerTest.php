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
        $tests = [
            ['Jo Le Taxi', 'Jo-Le-Taxi'],
            ['Bonjour ça va 22 ?', 'Bonjour-ca-va-22']
        ];


        $slugger = new MySlugger(new AsciiSlugger(), false);
        foreach ($tests as $test) {
            $this->assertEquals($test[1], $slugger->slugify($test[0]));
        }
    }
}
