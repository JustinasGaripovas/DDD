<?php

declare(strict_types=1);

namespace AcmeVet\Diagnosis\Application\Command\Diagnosing;

use AcmeVet\Scheduling\Application\Command\Command;

class PetDiagnosingCommand implements Command
{
    private \DateTimeImmutable $diagnosisDateTime;
    private string $petName;
    private string $ownerName;
    private string $contactNumber;
    private string $severity;
    private string $notes;
    private array $allergies;

    public function __construct(
        \DateTimeImmutable $diagnosisDateTime,
        string $petName,
        string $ownerName,
        string $contactNumber,
        string $severity,
        string $notes,
        array $allergies
    ) {
        $this->diagnosisDateTime = $diagnosisDateTime;
        $this->petName = $petName;
        $this->ownerName = $ownerName;
        $this->contactNumber = $contactNumber;
        $this->severity = $severity;
        $this->notes = $notes;
        $this->allergies = $allergies;
    }

    public function getSeverity(): string
    {
        return $this->severity;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getAllergies(): array
    {
        return $this->allergies;
    }

    public function getDiagnosisDateTime(): \DateTimeImmutable
    {
        return $this->diagnosisDateTime;
    }

    public function getPetName(): string
    {
        return $this->petName;
    }

    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function getContactNumber(): string
    {
        return $this->contactNumber;
    }
}
