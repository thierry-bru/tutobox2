<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220153608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_activite ADD activite_id INT DEFAULT NULL, ADD filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE support_activite ADD CONSTRAINT FK_CC3DE2A9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite_seance (id)');
        $this->addSql('CREATE INDEX IDX_CC3DE2A9B0F88B1 ON support_activite (activite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_activite DROP FOREIGN KEY FK_CC3DE2A9B0F88B1');
        $this->addSql('DROP INDEX IDX_CC3DE2A9B0F88B1 ON support_activite');
        $this->addSql('ALTER TABLE support_activite DROP activite_id, DROP filename');
    }
}
