<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319131203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_revision (id INT AUTO_INCREMENT NOT NULL, sequence_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, fiche VARCHAR(255) NOT NULL, INDEX IDX_B7D2F5D98FB19AE (sequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_revision ADD CONSTRAINT FK_B7D2F5D98FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_revision DROP FOREIGN KEY FK_B7D2F5D98FB19AE');
        $this->addSql('DROP TABLE fiche_revision');
    }
}
