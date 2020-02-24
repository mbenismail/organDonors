<?php

namespace App\Controller\admin ;

use App\Entity\Customers;
use App\Entity\Orders;
use App\Entity\StoreManager;
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


        return $this->render('admin/index.html.twig' , ['breadcrumb'=>'Dashboard'] );
    }
}
