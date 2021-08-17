<?php
declare(strict_types=1);

namespace AcmeVet\Scheduling\Application\Command\Booking;

use AcmeVet\Scheduling\Application\Command\Command;

class AppointmentBookingCommand implements Command
{
    private \DateTimeImmutable $appointmentTime;
    private string $petName;
    private string $ownerName;
    private string $contactNumber;
    private int $appointmentLengthInMinutes;

    public function __construct(
        \DateTimeImmutable $appointmentTime,
        string $petName,
        string $ownerName,
        string $contactNumber,
        int $appointmentLengthInMinutes
    ) {
        $this->appointmentTime = $appointmentTime;
        $this->petName = $petName;
        $this->ownerName = $ownerName;
        $this->contactNumber = $contactNumber;
        $this->appointmentLengthInMinutes = $appointmentLengthInMinutes;
    }

    public function getAppointmentTime(): \DateTimeImmutable
    {
        return $this->appointmentTime;
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

    public function getAppointmentLengthInMinutes(): int
    {
        return $this->appointmentLengthInMinutes;
    }
}
