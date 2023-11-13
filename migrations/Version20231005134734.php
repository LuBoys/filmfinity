<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005134734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, films_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, delete VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045F939610EE ON image (films_id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F939610EE');
        $this->addSql('DROP TABLE image');
    }
}
