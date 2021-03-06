<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616222255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE condidature (id INT AUTO_INCREMENT NOT NULL, id_offer_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, INDEX IDX_FDF2E30B31D987B (id_offer_id), INDEX IDX_FDF2E30B79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE condidature ADD CONSTRAINT FK_FDF2E30B31D987B FOREIGN KEY (id_offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE condidature ADD CONSTRAINT FK_FDF2E30B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE condidature');
    }
}
