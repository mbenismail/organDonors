<?php


namespace App\Controller\admin;

use App\Entity\Donor;
use App\Entity\Hospital;
use App\Entity\MatchingTest;
use App\Entity\Patient;
use App\Repository\DonorRepository;
use App\Repository\HospitalRepository;
use App\Repository\MatchingTestRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;

/**
 * @Route("/admin/matching")
 */
class MatchingController extends AbstractController
{
    /**
     * @Route("/", name="matching_index", methods={"GET"})
     */
    public function index(Request $request , DonorRepository $donorRepository , PatientRepository $patientRepository): Response
    {
        $id =$request->query->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $Currentpatient= new Patient();

        $Currentpatient = $entityManager->getRepository(Patient::class)->findOneBy(['id'=>$id]) ;
        //dump($Currentpatient);
        if ($Currentpatient) {
            $bloodtype = $Currentpatient->getBloodType() ;
            $organNeed = $Currentpatient->getOrganDonation() ;
            return $this->render('hospital/matching.html.twig', [
                'donors' => $donorRepository->finddonors($bloodtype , $organNeed),
                'patients' => $patientRepository->findBy(array(), array('isurgent' => 'DESC'  , 'id' => 'ASC' ))
            ]);
        }
        return $this->render('hospital/matching.html.twig', [
            'donors' =>  null ,
            'patients' => $patientRepository->findBy(array(), array('isurgent' => 'DESC'  , 'id' => 'ASC' ))
        ]);
    }

    /**
     * @Route("/affectdonor/{id}", name="matching_affect", methods={"GET" , "POST"})
     */
    public function affectdonor(Request $request, Donor $donor): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $matching = new MatchingTest() ;
            $matching->setDonor($donor) ;
            $matching->setOperationDateTime(new \DateTime('0000-00-00 00:00:00')) ;
            $matching->setPatient($entityManager->getRepository(Patient::class)->find($request->request->get('idpatient'))) ;
            $entityManager->persist($matching);
            $donor->setHasDonored(1) ;
            $entityManager->persist($donor);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Matching donor with patient have been done with success'
            );

        return $this->redirectToRoute('ListMatching');
    }

    /**
     * @Route("/sendmessageforope/{id}/{donor}/{patient}", name="sendmessageforope", methods={"GET" , "POST"})
     */
    public function sendmessageforope(Request $request, MatchingTest $matchingTest , Donor $donor , Patient $patient , Client $twilio): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $matchingTest->setOperationDateTime(new \DateTime($request->request->get('operation')['AppTime']));
        $entityManager->persist($matchingTest);
        $entityManager->flush();

        //send messages

        dump('Good morning ' . $donor->getFirstName() . ' ' . $donor->getLastName() . ' : your appointment for the operation is for : ' . $matchingTest->getOperationDateTime()->format('Y-m-d H:i:s') ) ;

        dump('Good morning ' . $patient->getFullname() . ' : your appointment for the operation is for : ' . $matchingTest->getOperationDateTime()->format('Y-m-d H:i:s') ) ;

        $message = $twilio->messages->create(
            '+966533571248', // Send text to this number
            array(
                "from" => "+12076106607", //
                'body' => 'Good morning ' . $donor->getFirstName() . ' ' . $donor->getLastName() . ' : your appointment for the operation is for : ' . $matchingTest->getOperationDateTime()->format('Y-m-d H:i:s')
            )
        );

        //display success message

        $this->addFlash(
            'success',
            'Messages has been sent successfully to patient and donor'
        );
        //send
        return $this->redirectToRoute('ListMatching');

    }

    /**
     * @Route("/ListMatching", name="ListMatching", methods={"GET"})
     */
    public function ListMatching( MatchingTestRepository $matchingTestRepository): Response
    {
        return $this->render('hospital/matchingList.html.twig', [
            'matchingtests' => $matchingTestRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="matching_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MatchingTest $matchingTest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matchingTest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matchingTest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ListMatching');
    }


}
