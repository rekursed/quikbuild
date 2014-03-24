<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140325015230 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE cart ADD CONSTRAINT FK_BA388B7B092A811 FOREIGN KEY (store_id) REFERENCES store (id)");
        $this->addSql("CREATE INDEX IDX_BA388B7B092A811 ON cart (store_id)");
        $this->addSql("ALTER TABLE product ADD parent_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE product ADD CONSTRAINT FK_D34A04AD727ACA70 FOREIGN KEY (parent_id) REFERENCES product (id)");
        $this->addSql("CREATE INDEX IDX_D34A04AD727ACA70 ON product (parent_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7B092A811");
        $this->addSql("DROP INDEX IDX_BA388B7B092A811 ON cart");
        $this->addSql("ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD727ACA70");
        $this->addSql("DROP INDEX IDX_D34A04AD727ACA70 ON product");
        $this->addSql("ALTER TABLE product DROP parent_id");
    }
}
