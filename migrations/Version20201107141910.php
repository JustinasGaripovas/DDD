<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201107141910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add the table for appointments in the AcmeVet\Appointment context';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE appointments (
                id VARCHAR(255)  PRIMARY KEY,
                start_time VARCHAR(200), 
                length INT(50),
                pet_name VARCHAR(200), 
                owner_name VARCHAR(200),
                contact_number VARCHAR(200)
              )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE appointments');
    }
}
