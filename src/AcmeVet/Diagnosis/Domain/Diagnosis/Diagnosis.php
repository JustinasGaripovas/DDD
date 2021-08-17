<?php


namespace AcmeVet\Diagnosis\Domain\Diagnosis;



use AcmeVet\Diagnosis\Domain\Diagnosis\Exception\DiagnosisSeverityInvalid;

class Diagnosis
{
    const SEVERITY_LEVELS = [
        'SEVERE',
        'HIGH',
        'NORMAL',
        'LOW',
    ];

    private DiagnosisId $appointmentId;
    private string $severity;
    private string $notes;
    private Pet $pet;
    private \DateTimeImmutable $diagnosisTime;

    private function __construct(
        DiagnosisId $diagnosisId,
        Pet $pet,
        \DateTimeImmutable $diagnosisDateTime,
        string $severity,
        string $notes
    ) {
        $this->appointmentId = $diagnosisId;
        $this->pet = $pet;
        $this->diagnosisTime = $diagnosisDateTime;

        if(!in_array($severity, self::SEVERITY_LEVELS))
        {
            throw new DiagnosisSeverityInvalid(
                sprintf("Diagnosis severity field is invalid field must be one of %s",
                json_encode(self::SEVERITY_LEVELS))
            );
        }

        $this->severity = $severity;
        $this->notes = $notes;
    }

    public static function create(
        DiagnosisId $diagnosisId,
        Pet $pet,
        \DateTimeImmutable $diagnosisTime,
        string $severity,
        string $notes
    ): self {
        return new self($diagnosisId, $pet, $diagnosisTime, $severity, $notes);
    }

    public function getAppointmentId(): DiagnosisId
    {
        return $this->appointmentId;
    }

    public function getSeverity(): string
    {
        return $this->severity;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getDiagnosisDateTime(): \DateTimeImmutable
    {
        return $this->diagnosisTime;
    }

    public function getId(): DiagnosisId
    {
        return $this->appointmentId;
    }

    public function getPet(): Pet
    {
        return $this->pet;
    }

    public function isSeverityLow(): bool
    {
        return $this->severity === 'LOW';

    }
}