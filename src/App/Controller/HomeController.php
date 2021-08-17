<?php

namespace App\Controller;

use AcmeVet\Diagnosis\Application\Query\DiagnosisQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home");
     */
    public function view(DiagnosisQuery $diagnosisQuery): Response
    {
        return $this->render('home/list.html.twig', []);
    }
}
