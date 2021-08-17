<?php


namespace AcmeVet\Treatment\Application\Command;


class PetDiagnosingCompleteCommand
{
    private \DateTimeImmutable $diagnosisDateTime;
    private string $petName;
    private string $ownerName;
    private string $severity;
    private string $notes;
    private array $allergies;
    private string $id;

    public function __construct(
        string $id,
        \DateTimeImmutable $diagnosisDateTime,
        string $petName,
        string $ownerName,
        array $allergies,
        string $severity,
        string $notes
    ) {
        $this->diagnosisDateTime = $diagnosisDateTime;
        $this->petName = $petName;
        $this->ownerName = $ownerName;
        $this->severity = $severity;
        $this->notes = $notes;
        $this->allergies = $allergies;
        $this->id = $id;
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

    public function getId(): string
    {
        return $this->id;
    }
}