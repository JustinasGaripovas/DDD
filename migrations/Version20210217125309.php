<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217125309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE diagnosis (
                id VARCHAR(255)  PRIMARY KEY,
                start_time VARCHAR(200), 
                pet_name VARCHAR(200), 
                owner_name VARCHAR(200),
                contact_number VARCHAR(200),
                severity VARCHAR(200),
                notes VARCHAR(200)
              )
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE diagnosis');
    }
}
