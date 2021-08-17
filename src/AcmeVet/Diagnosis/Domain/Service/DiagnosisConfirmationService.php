<?php


namespace AcmeVet\Diagnosis\Domain\Service;


use AcmeVet\Diagnosis\Domain\Diagnosis\Diagnosis;
use AcmeVet\Diagnosis\Domain\Diagnosis\DiagnosisRepository;

class DiagnosisConfirmationService
{
    private DiagnosisRepository $diagnosisRepository;

    public function __construct(DiagnosisRepository $diagnosisRepository)
    {
        $this->diagnosisRepository = $diagnosisRepository;
    }

    public function confirmDiagnosis(Diagnosis $diagnosis): void
    {
        if (!$diagnosis->isSeverityLow()) {
            $this->diagnosisRepository->store($diagnosis);
        }
    }
}