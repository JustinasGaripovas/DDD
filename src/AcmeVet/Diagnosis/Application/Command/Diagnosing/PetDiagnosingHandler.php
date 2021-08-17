<?php declare(strict_types=1);

namespace AcmeVet\Diagnosis\Application\Command\Diagnosing;

use AcmeVet\Diagnosis\Domain\Diagnosis\Diagnosis;
use AcmeVet\Diagnosis\Domain\Diagnosis\DiagnosisId;
use AcmeVet\Diagnosis\Domain\Diagnosis\Exception\CouldNotConfirmDiagnosisException;
use AcmeVet\Diagnosis\Domain\Diagnosis\Pet;
use AcmeVet\Diagnosis\Domain\Service\DiagnosisConfirmationService;
use AcmeVet\Treatment\Application\Command\PetDiagnosingCompleteCommand;
use Symfony\Component\Messenger\MessageBusInterface;

class PetDiagnosingHandler
{
    private MessageBusInterface $messageBus;
    private DiagnosisConfirmationService $confirmationService;

    public function __construct(MessageBusInterface $messageBus, DiagnosisConfirmationService $confirmationService)
    {
        $this->messageBus = $messageBus;
        $this->confirmationService = $confirmationService;
    }

    public function __invoke(PetDiagnosingCommand $command): void
    {
        $diagnosis = Diagnosis::create(
            DiagnosisId::generate(),
            Pet::create(
                $command->getPetName(),
                $command->getOwnerName(),
                $command->getAllergies()
            ),
            $command->getDiagnosisDateTime(),
            $command->getSeverity(),
            $command->getNotes(),
        );

        try {
            $this->confirmationService->confirmDiagnosis($diagnosis);
            $this->publishEvent($diagnosis);
        } catch (CouldNotConfirmDiagnosisException $confirmDiagnosisException) {
            throw new \RuntimeException("The diagnosis could not be diagnosis criteria");
        }
    }

    private function publishEvent(Diagnosis $diagnosis)
    {
        $command = new PetDiagnosingCompleteCommand(
            $diagnosis->getId()->toString(),
            $diagnosis->getDiagnosisDateTime(),
            $diagnosis->getPet()->getName(),
            $diagnosis->getPet()->getOwnerName(),
            $diagnosis->getPet()->getAllergies(),
            $diagnosis->getSeverity(),
            $diagnosis->getNotes(),
        );

        $this->messageBus->dispatch($command);
    }
}
