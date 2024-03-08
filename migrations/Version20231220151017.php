<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220151017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etape_formateur_activite (id INT AUTO_INCREMENT NOT NULL, activite_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, ordre SMALLINT NOT NULL, INDEX IDX_9DBBB40E9B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape_stagiaire_activite (id INT AUTO_INCREMENT NOT NULL, activite_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, ordre SMALLINT NOT NULL, INDEX IDX_2EEB3A809B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape_formateur_activite ADD CONSTRAINT FK_9DBBB40E9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite_seance (id)');
        $this->addSql('ALTER TABLE etape_stagiaire_activite ADD CONSTRAINT FK_2EEB3A809B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite_seance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape_formateur_activite DROP FOREIGN KEY FK_9DBBB40E9B0F88B1');
        $this->addSql('ALTER TABLE etape_stagiaire_activite DROP FOREIGN KEY FK_2EEB3A809B0F88B1');
        $this->addSql('DROP TABLE etape_formateur_activite');
        $this->addSql('DROP TABLE etape_stagiaire_activite');
    }
}
