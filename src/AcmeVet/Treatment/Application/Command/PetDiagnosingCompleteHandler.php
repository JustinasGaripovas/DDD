<?php declare(strict_types=1);

namespace AcmeVet\Treatment\Application\Command;

class PetDiagnosingCompleteHandler
{
    public function __invoke(PetDiagnosingCompleteCommand $command): void
    {
        $diagnosisId = $command->getId();

        //TODO: We grab entity from database by entity id
        //TODO: We transform full entity to our domain entity

        echo "Yay command completed !!! \n";
        echo "Time to start treating poor fella \n";
        echo "Diagnosis id is $diagnosisId \n" ;
        echo "We can edit diagnosis or do more stuff with it" ;
    }
}
