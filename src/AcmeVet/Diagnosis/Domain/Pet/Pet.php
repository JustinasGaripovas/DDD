<?php

namespace AcmeVet\Diagnosis\Domain\Pet;

class Pet
{
    private string $name;
    private string $note;
    private string $priorityLevel;
    private bool $isTreatmentRequired;

    private function __construct(string $name, string $note, string $priorityLevel, bool $isTreatmentRequired)
    {
        $this->priorityLevel = $priorityLevel;
        $this->name = $name;
        $this->note = $note;
        $this->isTreatmentRequired = $isTreatmentRequired;
    }

    public static function create(string $name, string $note, string $priorityLevel, bool $isTreatmentRequired): self
    {
        return new self($name, $note, $priorityLevel, $isTreatmentRequired);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getPriorityLevel(): string
    {
        return $this->priorityLevel;
    }

    public function isTreatmentRequired(): bool
    {
        return $this->isTreatmentRequired;
    }
}
