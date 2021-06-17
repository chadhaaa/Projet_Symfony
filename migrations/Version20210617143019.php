<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617143019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE condidature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE condidature (id INT NOT NULL, id_offer_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, lettremotivation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FDF2E30B31D987B ON condidature (id_offer_id)');
        $this->addSql('CREATE INDEX IDX_FDF2E30B79F37AE5 ON condidature (id_user_id)');
        $this->addSql('ALTER TABLE condidature ADD CONSTRAINT FK_FDF2E30B31D987B FOREIGN KEY (id_offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE condidature ADD CONSTRAINT FK_FDF2E30B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER roles TYPE JSON');
        $this->addSql('ALTER TABLE "user" ALTER roles DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER roles SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE condidature_id_seq CASCADE');
        $this->addSql('DROP TABLE condidature');
        $this->addSql('ALTER TABLE "user" ALTER roles TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER roles DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER roles DROP NOT NULL');
    }
}
