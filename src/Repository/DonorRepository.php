<?php

namespace App\Repository;

use App\Entity\Donor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Donor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donor[]    findAll()
 * @method Donor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donor::class);
    }

     /**
      * @return Donor[] Returns an array of Donor objects
      */

    public function finddonors($blood , $organ)
    {

        $listblood = '' ;

        switch ($blood) {
            case 'O-':
                $listblood = "('O-')";
                break ;
            case 'O+':
                $listblood = "('O-','O+')" ;
                break ;
            case 'A-':
                $listblood = "('O-', 'A-')" ;
                break ;
            case 'A+':
                $listblood = "('O-', 'O+', 'A-' , 'A+')" ;
                break ;
            case 'B-':
                $listblood = "('O-', 'B-')" ;
                break ;
            case 'B+':
                $listblood = "('O-', 'O+', 'B-' , 'B+')" ;
                break ;
            case 'AB-':
                $listblood = "('O-', 'B-', 'A-' , 'AB-')" ;
                break ;
            case 'AB+':
                $listblood = "('O-', 'O+', 'A-' , 'A+' , 'B-' , 'B+' , 'AB-' , 'AB+')" ;
                break ;
        }
        return $this->createQueryBuilder('d')
            ->andWhere('d.BloodType in '.$listblood.' and d.OrganDonation = :od')
            ->setParameter('od', $organ)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Donor
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
