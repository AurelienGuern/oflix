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

        
        $slugger = new MySlugger(new AsciiSlugger(), false);
        $this->assertEquals('Jo-Le-Taxi', $slugger->slugify('Jo Le Taxi'));
    }
}
