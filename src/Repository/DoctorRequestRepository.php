<?php

namespace App\Repository;

use App\Entity\DoctorRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DoctorRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctorRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctorRequest[]    findAll()
 * @method DoctorRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctorRequest::class);
    }

    // /**
    //  * @return DoctorRequest[] Returns an array of DoctorRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctorRequest
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
