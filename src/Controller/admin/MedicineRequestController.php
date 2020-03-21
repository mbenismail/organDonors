<?php

namespace App\Controller\admin;

use App\Entity\MedicineRequest;
use App\Form\MedicineRequestType;
use App\Repository\MedicineRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/medicine/request")
 */
class MedicineRequestController extends AbstractController
{
    /**
     * @Route("/", name="medicine_request_index", methods={"GET"})
     */
    public function index(MedicineRequestRepository $medicineRequestRepository): Response
    {
        return $this->render('medicine_request/index.html.twig', [
            'medicine_requests' => $medicineRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="medicine_request_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicineRequest = new MedicineRequest();
        $form = $this->createForm(MedicineRequestType::class, $medicineRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicineRequest);
            $entityManager->flush();

            return $this->redirectToRoute('medicine_request_index');
        }

        return $this->render('medicine_request/new.html.twig', [
            'medicine_request' => $medicineRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicine_request_show", methods={"GET"})
     */
    public function show(MedicineRequest $medicineRequest): Response
    {
        return $this->render('medicine_request/show.html.twig', [
            'medicine_request' => $medicineRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medicine_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MedicineRequest $medicineRequest): Response
    {
        $form = $this->createForm(MedicineRequestType::class, $medicineRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicine_request_index');
        }

        return $this->render('medicine_request/edit.html.twig', [
            'medicine_request' => $medicineRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicine_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MedicineRequest $medicineRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicineRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicineRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicine_request_index');
    }
}
