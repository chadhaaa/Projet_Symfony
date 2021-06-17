<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616220417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD etablissment VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD diplome VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD experience VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD date_naissance DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP etablissment');
        $this->addSql('ALTER TABLE "user" DROP diplome');
        $this->addSql('ALTER TABLE "user" DROP experience');
        $this->addSql('ALTER TABLE "user" DROP date_naissance');
    }
}
