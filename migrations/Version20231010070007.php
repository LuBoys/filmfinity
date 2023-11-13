<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010070007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP CONSTRAINT fk_c53d045f939610ee');
        $this->addSql('DROP INDEX idx_c53d045f939610ee');
        $this->addSql('ALTER TABLE image ADD photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image DROP delete');
        $this->addSql('ALTER TABLE image DROP image_name');
        $this->addSql('ALTER TABLE image DROP updated_at');
        $this->addSql('ALTER TABLE image RENAME COLUMN films_id TO imagefilm_id');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F51E8C8 FOREIGN KEY (imagefilm_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C53D045F51E8C8 ON image (imagefilm_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F51E8C8');
        $this->addSql('DROP INDEX IDX_C53D045F51E8C8');
        $this->addSql('ALTER TABLE image ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE image RENAME COLUMN imagefilm_id TO films_id');
        $this->addSql('ALTER TABLE image RENAME COLUMN photo TO delete');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT fk_c53d045f939610ee FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c53d045f939610ee ON image (films_id)');
    }
}
