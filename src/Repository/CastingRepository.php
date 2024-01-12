<?php

namespace App\Repository;

use App\Entity\Movie;
use App\Entity\Casting;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Casting>
 *
 * @method Casting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Casting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Casting[]    findAll()
 * @method Casting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CastingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Casting::class);
    }

    /**
     * Permet par une jointure de récupérer un une seule requête tous les acteurs du film
     *
     * @param Movie $movie
     * @return array Movie
     */
    public function findCastingsForMovie(Movie $movie): array
    {
        // on crée la requête sur l'objet Casting ('c')
        return $this->createQueryBuilder('c')
            // il faut aussi retourner l'objet Person, c'est ce qu'on recherche
            ->addSelect('p')
            // on fait la jointure grace à la relation ManyToOne entre Casting et Person
            ->innerJoin('c.person', 'p')
            // on tri comme besoin
            ->orderBy('c.creditOrder', 'ASC')
            // on limite aux acteurs du film passé en paramètre
            ->andWhere('c.movie = :movie')
            // pour la sécurité, on prépare notre requête
            ->setParameter('movie', $movie)
            // on éxécute
            ->getQuery()
            // on renvoie le tableau de résultats
            ->getResult();

        // même requête en DQL
        // $entityManager = $this->getEntityManager();

        // $query = $entityManager->createQuery(
        //     'SELECT c, p
        //     FROM App\Entity\Casting c
        //     INNER JOIN c.person AS p
        //     WHERE c.movie = :movie
        //     ORDER BY c.creditOrder ASC'
        // )->setParameter('movie', $movie);

        // // returns an array of Movie objects
        // return $query->getResult();
    }

// SELECT p.*, c.*
// FROM casting c
// INNER JOIN person p
// ON c.person_id = p.id
// WHERE c.movie_id=36
// ORDER BY c.credit_order;

//    /**
//     * @return Casting[] Returns an array of Casting objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Casting
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
