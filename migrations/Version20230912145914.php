<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912145914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE acteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commentaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE favorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE films_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE notes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE producteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE realisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE acteur (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, nickname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE acteur_films (acteur_id INT NOT NULL, films_id INT NOT NULL, PRIMARY KEY(acteur_id, films_id))');
        $this->addSql('CREATE INDEX IDX_82132EA0DA6F574A ON acteur_films (acteur_id)');
        $this->addSql('CREATE INDEX IDX_82132EA0939610EE ON acteur_films (films_id)');
        $this->addSql('CREATE TABLE commentaire (id INT NOT NULL, users_id INT DEFAULT NULL, films_id INT DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_commentaire TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, moderation TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BC67B3B43D ON commentaire (users_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC939610EE ON commentaire (films_id)');
        $this->addSql('CREATE TABLE favorie (id INT NOT NULL, users_id INT DEFAULT NULL, films_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7DE7716367B3B43D ON favorie (users_id)');
        $this->addSql('CREATE INDEX IDX_7DE77163939610EE ON favorie (films_id)');
        $this->addSql('CREATE TABLE films (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, duree VARCHAR(255) DEFAULT NULL, moderation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE genre_films (genre_id INT NOT NULL, films_id INT NOT NULL, PRIMARY KEY(genre_id, films_id))');
        $this->addSql('CREATE INDEX IDX_73EAD5944296D31F ON genre_films (genre_id)');
        $this->addSql('CREATE INDEX IDX_73EAD594939610EE ON genre_films (films_id)');
        $this->addSql('CREATE TABLE notes (id INT NOT NULL, films_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_11BA68C939610EE ON notes (films_id)');
        $this->addSql('CREATE TABLE producteur (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, nickname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE producteur_films (producteur_id INT NOT NULL, films_id INT NOT NULL, PRIMARY KEY(producteur_id, films_id))');
        $this->addSql('CREATE INDEX IDX_7FDC262AAB9BB300 ON producteur_films (producteur_id)');
        $this->addSql('CREATE INDEX IDX_7FDC262A939610EE ON producteur_films (films_id)');
        $this->addSql('CREATE TABLE realisateur (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, nickname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE realisateur_films (realisateur_id INT NOT NULL, films_id INT NOT NULL, PRIMARY KEY(realisateur_id, films_id))');
        $this->addSql('CREATE INDEX IDX_AF7D8D4CF1D8422E ON realisateur_films (realisateur_id)');
        $this->addSql('CREATE INDEX IDX_AF7D8D4C939610EE ON realisateur_films (films_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, notes_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE INDEX IDX_1483A5E9FC56F556 ON users (notes_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE acteur_films ADD CONSTRAINT FK_82132EA0DA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE acteur_films ADD CONSTRAINT FK_82132EA0939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE7716367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE77163939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_films ADD CONSTRAINT FK_73EAD5944296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_films ADD CONSTRAINT FK_73EAD594939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producteur_films ADD CONSTRAINT FK_7FDC262AAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producteur_films ADD CONSTRAINT FK_7FDC262A939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE realisateur_films ADD CONSTRAINT FK_AF7D8D4CF1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE realisateur_films ADD CONSTRAINT FK_AF7D8D4C939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE acteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commentaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE favorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE films_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE notes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE producteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE realisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE acteur_films DROP CONSTRAINT FK_82132EA0DA6F574A');
        $this->addSql('ALTER TABLE acteur_films DROP CONSTRAINT FK_82132EA0939610EE');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC67B3B43D');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC939610EE');
        $this->addSql('ALTER TABLE favorie DROP CONSTRAINT FK_7DE7716367B3B43D');
        $this->addSql('ALTER TABLE favorie DROP CONSTRAINT FK_7DE77163939610EE');
        $this->addSql('ALTER TABLE genre_films DROP CONSTRAINT FK_73EAD5944296D31F');
        $this->addSql('ALTER TABLE genre_films DROP CONSTRAINT FK_73EAD594939610EE');
        $this->addSql('ALTER TABLE notes DROP CONSTRAINT FK_11BA68C939610EE');
        $this->addSql('ALTER TABLE producteur_films DROP CONSTRAINT FK_7FDC262AAB9BB300');
        $this->addSql('ALTER TABLE producteur_films DROP CONSTRAINT FK_7FDC262A939610EE');
        $this->addSql('ALTER TABLE realisateur_films DROP CONSTRAINT FK_AF7D8D4CF1D8422E');
        $this->addSql('ALTER TABLE realisateur_films DROP CONSTRAINT FK_AF7D8D4C939610EE');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9FC56F556');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE acteur_films');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE favorie');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_films');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE producteur');
        $this->addSql('DROP TABLE producteur_films');
        $this->addSql('DROP TABLE realisateur');
        $this->addSql('DROP TABLE realisateur_films');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
