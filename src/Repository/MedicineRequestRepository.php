<?php

namespace App\Repository;

use App\Entity\MedicineRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MedicineRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicineRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicineRequest[]    findAll()
 * @method MedicineRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicineRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicineRequest::class);
    }

    // /**
    //  * @return MedicineRequest[] Returns an array of MedicineRequest objects
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
    public function findOneBySomeField($value): ?MedicineRequest
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
