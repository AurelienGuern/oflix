<?php

namespace  App\Model;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class MovieModel
{

    static private $movies = [

        '1' => [
            'id' => '1',
            'type' => 'Film',
            'title' => 'A Bug\'s Life',
            'release_date' => 1998,
            'duration' => 93,
            'summary' => 'Tilt, fourmi quelque peu ance la son.',
            'synopsis' => 'Tilt, fourmi quelque peu tête en.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNThmZGY4NzgtMTM4OC00NzNkLWEwNmEtMjdhMGY5YTc1NDE4XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',
            'rating' => 3.8
        ],

        '2' => [
            'id' => '2',
            'type' => 'Série',
            'title' => 'Game of Thrones',
            'release_date' => 2011,
            'duration' => 52,
            'summary' => 'Neuf familles .',
            'synopsis' => 'Il y a très longtemps, à une époque oubliée, une force a d',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_SX300.jpg',
            'rating' => 4.7
        ],
        '3' => [
            'id' => '3',
            'type' => 'Film',
            'title' => 'Aline',
            'release_date' => 2020,
            'duration' => 126,
            'summary' => 'Québec, fin des années 60, ',
            'synopsis' => 'Québec, fin des années 60 :',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNjUxYTQ3YzItNjU5Ny00ZGM0LWJkMGUtN2FkMWRiNjFlY2ExXkEyXkFqcGdeQXVyMzcwMzExMA@@._V1_SX300.jpg',
            'rating' => 4.0
        ],

        '4' => [
            'id' => '4',
            'type' => 'Série',
            'title' => 'Stranger Things',
            'release_date' => 2016,
            'duration' => 50,
            'summary' => '1983, à Hawkins dans l\'Indiana. ',
            'synopsis' => 'A Hawkins, ',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BN2ZmYjg1YmItNWQ4OC00YWM0LWE0ZDktYThjOTZiZjhhN2Q2XkEyXkFqcGdeQXVyNjgxNTQ3Mjk@._V1_SX300.jpg',
            'rating' => 4.2
        ],

    ];



    /**
     * Get the value of movies
     */
    static public function getMovies()
    {
        return self::$movies;
        // vu que c'est static on met self, sinon this
    }

    static public function getMovieById($id)
    {
        foreach (self::$movies as $movie) {


            $id = pathinfo(basename($id), PATHINFO_FILENAME);

            // Convertir en un entier si nécessaire


            if ($movie['id'] == $id) {
                return $movie;
            }
        }

        return null; // Retourne null si aucun film correspondant à l'ID n'est trouvé
    }

    static public function getFavoriteMovies(SessionInterface $session)
{
    return $session->get('favorite_movies', []);
}


}
