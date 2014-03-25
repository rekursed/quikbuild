<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140325104140 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE homeslide_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) DEFAULT NULL, sort INT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, body LONGTEXT DEFAULT NULL, image_path VARCHAR(100) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE homeslide_gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(300) NOT NULL, slug VARCHAR(128) DEFAULT NULL, home_slide TINYINT(1) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_C4B96A8A989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE homeslidegallery_homeslideimage (homeslidegallery_id INT NOT NULL, homeslideimage_id INT NOT NULL, INDEX IDX_E62C36AC5E0752F0 (homeslidegallery_id), INDEX IDX_E62C36ACCA7FD6A0 (homeslideimage_id), PRIMARY KEY(homeslidegallery_id, homeslideimage_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE home_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) DEFAULT NULL, sort INT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, body LONGTEXT DEFAULT NULL, image_path VARCHAR(100) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE homeslidegallery_homeslideimage ADD CONSTRAINT FK_E62C36AC5E0752F0 FOREIGN KEY (homeslidegallery_id) REFERENCES homeslide_gallery (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE homeslidegallery_homeslideimage ADD CONSTRAINT FK_E62C36ACCA7FD6A0 FOREIGN KEY (homeslideimage_id) REFERENCES homeslide_image (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE homeslidegallery_homeslideimage DROP FOREIGN KEY FK_E62C36ACCA7FD6A0");
        $this->addSql("ALTER TABLE homeslidegallery_homeslideimage DROP FOREIGN KEY FK_E62C36AC5E0752F0");
        $this->addSql("DROP TABLE homeslide_image");
        $this->addSql("DROP TABLE homeslide_gallery");
        $this->addSql("DROP TABLE homeslidegallery_homeslideimage");
        $this->addSql("DROP TABLE home_image");
    }
}
