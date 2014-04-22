<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140421124639 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE store ADD town VARCHAR(300) DEFAULT NULL, ADD city VARCHAR(300) DEFAULT NULL, ADD postcode VARCHAR(20) DEFAULT NULL, ADD contract_name VARCHAR(300) DEFAULT NULL, ADD contract_number VARCHAR(300) DEFAULT NULL, ADD contract_email VARCHAR(300) DEFAULT NULL, ADD company_reg_no VARCHAR(300) DEFAULT NULL, ADD vat_reg_no VARCHAR(300) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE store DROP town, DROP city, DROP postcode, DROP contract_name, DROP contract_number, DROP contract_email, DROP company_reg_no, DROP vat_reg_no");
    }
}
