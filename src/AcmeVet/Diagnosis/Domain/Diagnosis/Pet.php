<?php

namespace AcmeVet\Diagnosis\Domain\Diagnosis;

class Pet
{
    private string $name;
    private string $ownerName;
    private array $allergies;

    private function __construct(string $name, string $ownerName, array $allergies)
    {
        $this->name = $name;
        $this->ownerName = $ownerName;
        $this->allergies = $allergies;
    }

    public static function create(string $name, string $ownerName, array $allergies)
    {
        return new self($name, $ownerName, $allergies);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function getAllergies(): array
    {
        return $this->allergies;
    }
}
