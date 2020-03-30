<?php

namespace App\Controller\admin;

use App\Entity\DoctorRequest;
use App\Entity\Donor;
use App\Form\DoctorRequestType;
use App\Repository\DoctorRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/doctor/request")
 */
class DoctorRequestController extends AbstractController
{
    /**
     * @Route("/", name="doctor_request_index", methods={"GET"})
     */
    public function index(DoctorRequestRepository $doctorRequestRepository): Response
    {
        return $this->render('doctor_request/index.html.twig', [
            'doctor_requests' => $doctorRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="doctor_request_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $doctorRequest = new DoctorRequest();
        $form = $this->createForm(DoctorRequestType::class, $doctorRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $donordetails =  $entityManager->getRepository(Donor::class)->findOneBy(['id' => $this->get('session')->get('donor-id')  ]) ;

            if (!$donordetails) {
                $this->addFlash(
                    'error',
                    'Please verify your donor id '
                );
            }else {
                $doctorRequest->setDonor($donordetails);
                $entityManager->persist($doctorRequest);
                $this->addFlash(
                    'success',
                    'You application has been issued, you will  receive an email from the doctor asap'
                );
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('doctor_request_new');
            }

        }

        return $this->render('doctor_request/new.html.twig', [
            'doctor_request' => $doctorRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctor_request_show", methods={"GET"})
     */
    public function show(DoctorRequest $doctorRequest): Response
    {
        return $this->render('doctor_request/show.html.twig', [
            'doctor_request' => $doctorRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doctor_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DoctorRequest $doctorRequest): Response
    {
        $form = $this->createForm(DoctorRequestType::class, $doctorRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



        }

        return $this->render('doctor_request/edit.html.twig', [
            'doctor_request' => $doctorRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctor_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DoctorRequest $doctorRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctorRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doctorRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doctor_request_index');
    }
}
