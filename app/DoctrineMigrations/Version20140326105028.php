<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140326105028 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE favorite_item (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT DEFAULT NULL, INDEX IDX_F11D3C21A76ED395 (user_id), INDEX IDX_F11D3C214584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE favorite_stores (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, store_id INT DEFAULT NULL, INDEX IDX_E9251036A76ED395 (user_id), INDEX IDX_E9251036B092A811 (store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE favorite_item ADD CONSTRAINT FK_F11D3C21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)");
        $this->addSql("ALTER TABLE favorite_item ADD CONSTRAINT FK_F11D3C214584665A FOREIGN KEY (product_id) REFERENCES product (id)");
        $this->addSql("ALTER TABLE favorite_stores ADD CONSTRAINT FK_E9251036A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)");
        $this->addSql("ALTER TABLE favorite_stores ADD CONSTRAINT FK_E9251036B092A811 FOREIGN KEY (store_id) REFERENCES store (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE favorite_item");
        $this->addSql("DROP TABLE favorite_stores");
    }
}
