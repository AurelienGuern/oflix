<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{
    public function __construct(
        private SluggerInterface $slugger,
        // on injecte le paramètre qui provient du services.yaml et du .env
        private bool $toLower
    )
    {
    }

    public function slugify(string $text): string
    {
        $slug = $this->slugger->slug($text);
        if ($this->toLower) {
            $slug = $slug->lower();
        }

        return $slug;
    }
 
}
