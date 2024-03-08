<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219084045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_seance_modalite_activite (activite_seance_id INT NOT NULL, modalite_activite_id INT NOT NULL, INDEX IDX_36EA977A08D0B2F (activite_seance_id), INDEX IDX_36EA97752E44724 (modalite_activite_id), PRIMARY KEY(activite_seance_id, modalite_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_seance_materiel (activite_seance_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_3B0EA849A08D0B2F (activite_seance_id), INDEX IDX_3B0EA84916880AAF (materiel_id), PRIMARY KEY(activite_seance_id, materiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_seance_modalite_activite ADD CONSTRAINT FK_36EA977A08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_seance_modalite_activite ADD CONSTRAINT FK_36EA97752E44724 FOREIGN KEY (modalite_activite_id) REFERENCES modalite_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_seance_materiel ADD CONSTRAINT FK_3B0EA849A08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_seance_materiel ADD CONSTRAINT FK_3B0EA84916880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_seance ADD exercices_id INT DEFAULT NULL, ADD etude_de_cas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite_seance ADD CONSTRAINT FK_A61F396A192C7251 FOREIGN KEY (exercices_id) REFERENCES serie_exercices (id)');
        $this->addSql('ALTER TABLE activite_seance ADD CONSTRAINT FK_A61F396A361B6CFE FOREIGN KEY (etude_de_cas_id) REFERENCES etude_cas_activite (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A61F396A192C7251 ON activite_seance (exercices_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A61F396A361B6CFE ON activite_seance (etude_de_cas_id)');
        $this->addSql('ALTER TABLE modalite_activite ADD activite_seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modalite_activite ADD CONSTRAINT FK_EEB47E61A08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id)');
        $this->addSql('CREATE INDEX IDX_EEB47E61A08D0B2F ON modalite_activite (activite_seance_id)');
        $this->addSql('ALTER TABLE serie_exercices ADD activite_seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE serie_exercices ADD CONSTRAINT FK_3BCDD4D0A08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id)');
        $this->addSql('CREATE INDEX IDX_3BCDD4D0A08D0B2F ON serie_exercices (activite_seance_id)');
        $this->addSql('ALTER TABLE support_activite ADD activite_seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support_activite ADD CONSTRAINT FK_CC3DE2AA08D0B2F FOREIGN KEY (activite_seance_id) REFERENCES activite_seance (id)');
        $this->addSql('CREATE INDEX IDX_CC3DE2AA08D0B2F ON support_activite (activite_seance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_seance_modalite_activite DROP FOREIGN KEY FK_36EA977A08D0B2F');
        $this->addSql('ALTER TABLE activite_seance_modalite_activite DROP FOREIGN KEY FK_36EA97752E44724');
        $this->addSql('ALTER TABLE activite_seance_materiel DROP FOREIGN KEY FK_3B0EA849A08D0B2F');
        $this->addSql('ALTER TABLE activite_seance_materiel DROP FOREIGN KEY FK_3B0EA84916880AAF');
        $this->addSql('DROP TABLE activite_seance_modalite_activite');
        $this->addSql('DROP TABLE activite_seance_materiel');
        $this->addSql('ALTER TABLE activite_seance DROP FOREIGN KEY FK_A61F396A192C7251');
        $this->addSql('ALTER TABLE activite_seance DROP FOREIGN KEY FK_A61F396A361B6CFE');
        $this->addSql('DROP INDEX UNIQ_A61F396A192C7251 ON activite_seance');
        $this->addSql('DROP INDEX UNIQ_A61F396A361B6CFE ON activite_seance');
        $this->addSql('ALTER TABLE activite_seance DROP exercices_id, DROP etude_de_cas_id');
        $this->addSql('ALTER TABLE modalite_activite DROP FOREIGN KEY FK_EEB47E61A08D0B2F');
        $this->addSql('DROP INDEX IDX_EEB47E61A08D0B2F ON modalite_activite');
        $this->addSql('ALTER TABLE modalite_activite DROP activite_seance_id');
        $this->addSql('ALTER TABLE support_activite DROP FOREIGN KEY FK_CC3DE2AA08D0B2F');
        $this->addSql('DROP INDEX IDX_CC3DE2AA08D0B2F ON support_activite');
        $this->addSql('ALTER TABLE support_activite DROP activite_seance_id');
        $this->addSql('ALTER TABLE serie_exercices DROP FOREIGN KEY FK_3BCDD4D0A08D0B2F');
        $this->addSql('DROP INDEX IDX_3BCDD4D0A08D0B2F ON serie_exercices');
        $this->addSql('ALTER TABLE serie_exercices DROP activite_seance_id');
    }
}
