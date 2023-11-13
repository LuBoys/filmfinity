<?php

namespace App\Repository;

use App\Entity\LikesFilms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikesFilms>
 *
 * @method LikesFilms|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikesFilms|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikesFilms[]    findAll()
 * @method LikesFilms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesFilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikesFilms::class);
    }

//    /**
//     * @return LikesFilms[] Returns an array of LikesFilms objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LikesFilms
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
