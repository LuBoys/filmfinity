<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231019073736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes_films DROP CONSTRAINT fk_721066d7567f5183');
        $this->addSql('ALTER TABLE likes_films DROP CONSTRAINT fk_721066d7a76ed395');
        $this->addSql('DROP INDEX idx_721066d7a76ed395');
        $this->addSql('DROP INDEX idx_721066d7567f5183');
        $this->addSql('ALTER TABLE likes_films DROP film_id');
        $this->addSql('ALTER TABLE likes_films DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE likes_films ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE likes_films ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE likes_films ADD CONSTRAINT fk_721066d7567f5183 FOREIGN KEY (film_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE likes_films ADD CONSTRAINT fk_721066d7a76ed395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_721066d7a76ed395 ON likes_films (user_id)');
        $this->addSql('CREATE INDEX idx_721066d7567f5183 ON likes_films (film_id)');
    }
}
