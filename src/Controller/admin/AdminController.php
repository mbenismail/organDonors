<?php

namespace App\Controller\admin ;

use App\Entity\Customers;
use App\Entity\Donor;
use App\Entity\Hospital;
use App\Entity\Orders;
use App\Entity\Patient;
use App\Entity\StoreManager;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_home")
     */

    public function index()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $hos_count = $entityManager->getRepository(Hospital::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $patient_count = $entityManager->getRepository(Patient::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $donor_count = $entityManager->getRepository(Donor::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $user_count = $entityManager->getRepository(User::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('admin/index.html.twig' , ['hos_count' => $hos_count  ,'patient_count' => $patient_count
            ,'donor_count' => $donor_count  ,'user_count' => $user_count  ,'breadcrumb'=>'Dashboard'] );
    }
}
