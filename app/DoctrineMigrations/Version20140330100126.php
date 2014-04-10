<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140330100126 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sale DROP INDEX UNIQ_E54BC005A76ED395, ADD INDEX IDX_E54BC005A76ED395 (user_id)");
        $this->addSql("ALTER TABLE sale ADD store_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE sale ADD CONSTRAINT FK_E54BC005B092A811 FOREIGN KEY (store_id) REFERENCES store (id)");
        $this->addSql("CREATE INDEX IDX_E54BC005B092A811 ON sale (store_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sale DROP INDEX IDX_E54BC005A76ED395, ADD UNIQUE INDEX UNIQ_E54BC005A76ED395 (user_id)");
        $this->addSql("ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005B092A811");
        $this->addSql("DROP INDEX IDX_E54BC005B092A811 ON sale");
        $this->addSql("ALTER TABLE sale DROP store_id");
    }
}
