<?php

namespace App\Controller\admin;

use App\Entity\Donor;
use App\Form\DonorType;
use App\Repository\DonorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/donor")
 */
class DonorController extends AbstractController
{
    /**
     * @Route("/", name="donor_index", methods={"GET" , "POST"})
     */
    public function index(DonorRepository $donorRepository): Response
    {
        return $this->render('donor/index.html.twig', [
            'donors' => $donorRepository->findAll(),
        ]);
    }
    /**
     * @Route("/confirmation", name="donor_confirm", methods={"GET","POST"})
     */
    public function showConfirm (DonorRepository $donorRepository , Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('Code', TextType::class)
            ->add('Verify', SubmitType::class)
            ->getForm();

        $form->handleRequest($request );

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys


            $entityManager = $this->getDoctrine()->getManager();


            $id= $this->get('session')->get('user');

           $isver =  $entityManager->getRepository(Donor::class)->findOneBy(['emailcode' => $form->get('Code')->getData()  , 'id' => $id]) ;


           //dump($isver);
           if ($isver) {
               $isver->setVerified(1) ;
               $entityManager->persist($isver);
               $entityManager->flush();

               $this->addFlash(
                   'success',
                   'Thank you to verify your code'
               );
               return $this->redirectToRoute('app_login');
           }else{

               $this->addFlash(
                   'error',
                   'Please verify the code'
               );
           }
        }
        return $this->render('donor/show-confirmation.html.twig' , ['form' => $form->createView()]);
    }
    /**
     * @Route("/new", name="donor_new", methods={"GET","POST"})
     */
    public function new(Request $request , \Swift_Mailer $mailer): Response
    {
        $donor = new Donor();
        $form = $this->createForm(DonorType::class, $donor);
        $donor ->setEmailcode(rand(1000,9999)) ;
        $donor ->setVerified(0) ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($donor);
            $entityManager->flush();
            $message = (new \Swift_Message('Confirm your email'))
                ->setFrom(['saveorgans@gmail.com' => 'OrgansDonors'])
                ->setTo($donor->getEmail());
            $message->setBody($this->renderView('donor/mailcode.html.twig',
                ['name' => $donor->getFirstName(), 'code' => $donor->getEmailcode() ]),'text/html');
            $mailer->send($message);
            $this->get('session')->set('user', $donor->getId());
            return $this->redirectToRoute('donor_confirm');
        }

        return $this->render('donor/new.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_show", methods={"GET"})
     */
    public function show(Donor $donor): Response
    {
        return $this->render('donor/show.html.twig', [
            'donor' => $donor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="donor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Donor $donor): Response
    {
        $form = $this->createForm(DonorType::class, $donor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donor_index');
        }

        return $this->render('donor/edit.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Donor $donor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($donor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('donor_index');
    }
}
