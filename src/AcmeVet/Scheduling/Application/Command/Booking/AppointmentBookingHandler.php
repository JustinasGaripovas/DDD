<?php declare(strict_types=1);

namespace AcmeVet\Scheduling\Application\Command\Booking;

use AcmeVet\Scheduling\Application\Command\Command;
use AcmeVet\Scheduling\Application\Command\Handler;
use AcmeVet\Scheduling\Domain\Appointment\Appointment;
use AcmeVet\Scheduling\Domain\Appointment\AppointmentId;
use AcmeVet\Scheduling\Domain\Appointment\Exception\CouldNotConfirmSlotException;
use AcmeVet\Scheduling\Domain\Appointment\Pet;
use AcmeVet\Scheduling\Domain\Appointment\SlotConfirmationService;
use Symfony\Component\Messenger\MessageBusInterface;

class AppointmentBookingHandler
{
    private SlotConfirmationService $slotConfirmationService;

    public function __construct(SlotConfirmationService $slotConfirmationService)
    {
        $this->slotConfirmationService = $slotConfirmationService;
    }

    public function __invoke(AppointmentBookingCommand $command): void
    {
        $appointment = Appointment::create(
            AppointmentId::generate(),
            Pet::create(
                $command->getPetName(),
                $command->getOwnerName(),
                $command->getContactNumber()
            ),
            $command->getAppointmentTime(),
            $command->getAppointmentLengthInMinutes()
        );

        try {
            $this->slotConfirmationService->confirmSlot($appointment);
        } catch (CouldNotConfirmSlotException $couldNotConfirmSlotException) {
            throw new \RuntimeException("The slot could not be booked");
        }
    }
}
