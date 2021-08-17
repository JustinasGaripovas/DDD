<?php

namespace AcmeVet\Diagnosis\Application\Query;

class DiagnosisDTO
{
    private string $petName;
    private string $ownerName;
    private string $contactNumber;
    private array $allergies;
    private string $severity;
    private string $note;
    private string $id;

    public function __construct(
        string $id,
        string $petName,
        string $ownerName,
        string $contactNumber,
        array $allergies,
        string $severity,
        string $note
    )
    {
        $this->petName = $petName;
        $this->ownerName = $ownerName;
        $this->contactNumber = $contactNumber;
        $this->allergies = $allergies;
        $this->severity = $severity;
        $this->note = $note;
        $this->id = $id;
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

    public function getAllergies(): array
    {
        return $this->allergies;
    }

    public function getSeverity(): string
    {
        return $this->severity;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
