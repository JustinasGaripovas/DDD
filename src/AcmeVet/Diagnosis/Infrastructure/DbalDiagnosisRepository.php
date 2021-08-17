<?php

namespace AcmeVet\Diagnosis\Infrastructure;

use AcmeVet\Diagnosis\Domain\Diagnosis\Diagnosis;
use AcmeVet\Diagnosis\Domain\Diagnosis\DiagnosisId;
use AcmeVet\Diagnosis\Domain\Diagnosis\DiagnosisRepository;
use AcmeVet\Diagnosis\Domain\Diagnosis\Pet;
use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;

class DbalDiagnosisRepository implements DiagnosisRepository
{
    private const DATE_FORMAT = "h:i:s y:m:d";

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function store(Diagnosis $diagnosis): void
    {
        $stmt = $this->connection->prepare(
            '
            INSERT INTO diagnosis (id, start_time, pet_name, owner_name, contact_number, severity, notes)
            VALUES (:id, :start_time, :pet_name, :owner_name, :contact_number, :severity, :notes) 
        '
        );

        $stmt->bindValue('id', $diagnosis->getId()->toString());
        $stmt->bindValue('start_time', (new DateTime())->format('H:i:s y:m:d'));
        $stmt->bindValue('severity', $diagnosis->getSeverity());
        $stmt->bindValue('notes', $diagnosis->getNotes());
        $stmt->bindValue('pet_name', $diagnosis->getPet()->getName());
        $stmt->bindValue('owner_name', $diagnosis->getPet()->getOwnerName());
        $stmt->bindValue('contact_number', 'no_number');

        $stmt->execute();
    }

    public function getAll(): array
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM diagnosis
        ');

        $stmt->execute();

        $result = $stmt->fetchAllAssociative();

        return \array_map(function (array $row) {
            return
                Diagnosis::create(
                DiagnosisId::fromString($row['id']),
                Pet::create(
                    $row['pet_name'],
                    $row['owner_name'],
                    []
                ),
                new DateTimeImmutable(),
                $row['severity'],
                $row['notes']
            );
        }, $result);
    }
}
