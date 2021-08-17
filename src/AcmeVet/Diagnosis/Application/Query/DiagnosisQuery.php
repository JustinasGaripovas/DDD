<?php

namespace AcmeVet\Diagnosis\Application\Query;

use AcmeVet\Diagnosis\Domain\Diagnosis\Diagnosis;
use AcmeVet\Diagnosis\Domain\Diagnosis\DiagnosisRepository;

class DiagnosisQuery
{
    private DiagnosisRepository $repository;

    public function __construct(DiagnosisRepository $repository)
    {
        $this->repository = $repository;
    }

    public function fetchAll(): array
    {
        $results = $this->repository->getAll();

        return \array_map(function (Diagnosis $diagnosis) {
            return new DiagnosisDTO(
                $diagnosis->getId()->toString(),
                $diagnosis->getPet()->getName(),
                $diagnosis->getPet()->getOwnerName(),
                'no_number',
                $diagnosis->getPet()->getAllergies(),
                $diagnosis->getSeverity(),
                $diagnosis->getNotes()
            );
        }, $results);
    }
}
