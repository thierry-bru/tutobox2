<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219090036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, sequence_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, objectifs LONGTEXT NOT NULL, INDEX IDX_DF7DFD0E98FB19AE (sequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E98FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id)');
        $this->addSql('ALTER TABLE activite_seance ADD seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite_seance ADD CONSTRAINT FK_A61F396AE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('CREATE INDEX IDX_A61F396AE3797A94 ON activite_seance (seance_id)');
        $this->addSql('ALTER TABLE modalite_activite DROP FOREIGN KEY FK_EEB47E61A08D0B2F');
        $this->addSql('DROP INDEX IDX_EEB47E61A08D0B2F ON modalite_activite');
        $this->addSql('ALTER TABLE modalite_activite DROP activite_seance_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_seance DROP FOREIGN KEY FK_A61F396AE3797A94');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E98FB19AE');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP INDEX IDX_A61F396AE3797A94 ON activite_seance');
        $this->addSql('ALTER TABLE activite_seance DROP seance_id');
        $this->addSql('ALTER TABLE modalite_activite ADD activite_seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modalite_activite ADD CONSTRAINT FK_EEB47E61A08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EEB47E61A08D0B2F ON modalite_activite (activite_seance_id)');
    }
}
