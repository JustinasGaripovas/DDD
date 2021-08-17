<?php

namespace App\Tests\AcmeVet\Scheduling\Application\Command\Booking;

use AcmeVet\Scheduling\Application\Command\Diagnosing\AppointmentBookingCommand;
use AcmeVet\Scheduling\Application\Command\Diagnosing\AppointmentBookingHandler;
use AcmeVet\Scheduling\Domain\Appointment\SlotConfirmationService;
use Monolog\Test\TestCase;
use Tests\AcmeVet\Scheduling\Doubles\InMemoryAppointmentRepository;

class AppointmentBookingTest extends TestCase
{
    public function test_an_appointment_can_be_booked(): void
    {
        $appointmentTime = new \DateTimeImmutable();

        $command = new AppointmentBookingCommand(
            $appointmentTime,
            'Luna',
            'David Smith',
            '07500777123',
            15
        );

        $repository = new InMemoryAppointmentRepository();

        $handler = new AppointmentBookingHandler(new SlotConfirmationService($repository));
        $handler($command);

        $appointment = $repository->getAppointmentAtTime($appointmentTime);
        static::assertSame($appointmentTime, $appointment->getStartTime());
        static::assertSame('Luna', $appointment->getPet()->getName());
    }
}
