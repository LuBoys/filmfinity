<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Films>
 *
 * @method Films|null find($id, $lockMode = null, $lockVersion = null)
 * @method Films|null findOneBy(array $criteria, array $orderBy = null)
 * @method Films[]    findAll()
 * @method Films[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Films::class);
    }
    // Dans FilmsRepository.php

public function findByHighestRating()
{
    return $this->createQueryBuilder('f')
        ->leftJoin('f.commentaires', 'c')
        ->groupBy('f')
        ->orderBy('AVG(c.rating)', 'DESC')
        ->getQuery()
        ->getResult();
}


}