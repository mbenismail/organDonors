<?php

namespace App\Controller\admin;

use App\Entity\Appointement;
use App\Form\AppointementType;
use App\Repository\AppointementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Twilio\Rest\Client;

/**
 * @Route("/admin/appointement")
 */
class AppointementController extends AbstractController
{
    /**
     * @Route("/", name="appointement_index", methods={"GET"})
     */
    public function index(AppointementRepository $appointementRepository): Response
    {
        return $this->render('appointement/index.html.twig', [
            'appointements' => $appointementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="appointement_new", methods={"GET","POST"})
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function new(Request $request , Client $twilio): Response
    {
        $appointement = new Appointement();
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointement);
            $entityManager->flush();

            if($appointement->getDonor()) {

                dump('Good morning ' . $appointement->getDonor()->getFirstName() . ' ' . $appointement->getDonor()->getLastName() . ' : your appointment for analysis is for : ' . $appointement->getAppTime()->format('Y-m-d H:i:s') ) ;

                $message = $twilio->messages->create(
                    '+966533571248', // Send text to this number
                    array(
                        "from" => "+12076106607", //
                        'body' => 'Good morning ' . $appointement->getDonor()->getFirstName() . ' ' . $appointement->getDonor()->getLastName() . ' : your appointment for analysis is for : ' . $appointement->getAppTime()->format('Y-m-d H:i:s')
                    )
                );
            }
            return $this->redirectToRoute('appointement_index');
        }

        return $this->render('appointement/new.html.twig', [
            'appointement' => $appointement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appointement_show", methods={"GET"})
     */
    public function show(Appointement $appointement): Response
    {
        return $this->render('appointement/show.html.twig', [
            'appointement' => $appointement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="appointement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Appointement $appointement): Response
    {
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appointement_index');
        }

        return $this->render('appointement/edit.html.twig', [
            'appointement' => $appointement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appointement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Appointement $appointement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appointement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appointement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('appointement_index');
    }
}
