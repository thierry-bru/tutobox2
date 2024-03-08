<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214154726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_html (id INT AUTO_INCREMENT NOT NULL, sequence_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_2682069998FB19AE (sequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice_html ADD CONSTRAINT FK_2682069998FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_html DROP FOREIGN KEY FK_2682069998FB19AE');
        $this->addSql('DROP TABLE exercice_html');
    }
}
