<?php

namespace App\Controller;

use AcmeVet\Diagnosis\Application\Command\Diagnosing\PetDiagnosingCommand;
use AcmeVet\Diagnosis\Application\Query\DiagnosisQuery;
use App\Form\Type\DiagnosisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route as Route;

class DiagnosisController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/diagnoses", name="diagnoses_list");
     */
    public function view(DiagnosisQuery $diagnosisQuery): Response
    {
        return $this->render('diagnosis/list.html.twig', [
            'diagnoses' => $diagnosisQuery->fetchAll(),
        ]);
    }

    /**
     * @Route("/diagnosis/create", name="diagnosis_create");
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(DiagnosisType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $command = new PetDiagnosingCommand(
                $form->get('diagnosisDateTime')->getData(),
                $form->get('petName')->getData(),
                $form->get('ownerName')->getData(),
                $form->get('contactNumber')->getData(),
                $form->get('severity')->getData(),
                $form->get('notes')->getData(),
                $form->get('allergies')->getData()
            );
            $this->messageBus->dispatch($command);
        }

        return $this->render('diagnosis/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
