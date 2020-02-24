<?php

namespace App\Repository;

use App\Entity\MatchingTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MatchingTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchingTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchingTest[]    findAll()
 * @method MatchingTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchingTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchingTest::class);
    }

    // /**
    //  * @return MatchingTest[] Returns an array of MatchingTest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatchingTest
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
