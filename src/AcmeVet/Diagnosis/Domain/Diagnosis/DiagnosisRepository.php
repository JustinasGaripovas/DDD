<?php

namespace AcmeVet\Diagnosis\Domain\Diagnosis;

interface DiagnosisRepository
{
    public function store(Diagnosis $diagnosis): void;
    public function getAll(): array;
}
