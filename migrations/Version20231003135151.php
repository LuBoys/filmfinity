<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003135151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE likes_films_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE films_likes_films (films_id INT NOT NULL, likes_films_id INT NOT NULL, PRIMARY KEY(films_id, likes_films_id))');
        $this->addSql('CREATE INDEX IDX_95AE839B939610EE ON films_likes_films (films_id)');
        $this->addSql('CREATE INDEX IDX_95AE839BC0973AB2 ON films_likes_films (likes_films_id)');
        $this->addSql('CREATE TABLE likes_films (id INT NOT NULL, likes_films DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users_likes_films (users_id INT NOT NULL, likes_films_id INT NOT NULL, PRIMARY KEY(users_id, likes_films_id))');
        $this->addSql('CREATE INDEX IDX_85A55A2567B3B43D ON users_likes_films (users_id)');
        $this->addSql('CREATE INDEX IDX_85A55A25C0973AB2 ON users_likes_films (likes_films_id)');
        $this->addSql('ALTER TABLE films_likes_films ADD CONSTRAINT FK_95AE839B939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE films_likes_films ADD CONSTRAINT FK_95AE839BC0973AB2 FOREIGN KEY (likes_films_id) REFERENCES likes_films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_likes_films ADD CONSTRAINT FK_85A55A2567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_likes_films ADD CONSTRAINT FK_85A55A25C0973AB2 FOREIGN KEY (likes_films_id) REFERENCES likes_films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE likes_films_id_seq CASCADE');
        $this->addSql('ALTER TABLE films_likes_films DROP CONSTRAINT FK_95AE839B939610EE');
        $this->addSql('ALTER TABLE films_likes_films DROP CONSTRAINT FK_95AE839BC0973AB2');
        $this->addSql('ALTER TABLE users_likes_films DROP CONSTRAINT FK_85A55A2567B3B43D');
        $this->addSql('ALTER TABLE users_likes_films DROP CONSTRAINT FK_85A55A25C0973AB2');
        $this->addSql('DROP TABLE films_likes_films');
        $this->addSql('DROP TABLE likes_films');
        $this->addSql('DROP TABLE users_likes_films');
    }
}
