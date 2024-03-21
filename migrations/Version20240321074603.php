<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321074603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avancement_exercice (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercice_id INT NOT NULL, seance_id INT NOT NULL, sequence_id INT NOT NULL, module_id INT NOT NULL, cursus_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, est_fini TINYINT(1) NOT NULL, INDEX IDX_3F307D1EA76ED395 (user_id), INDEX IDX_3F307D1E89D40298 (exercice_id), INDEX IDX_3F307D1EE3797A94 (seance_id), INDEX IDX_3F307D1E98FB19AE (sequence_id), INDEX IDX_3F307D1EAFC2B591 (module_id), INDEX IDX_3F307D1E40AEF4B9 (cursus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1E89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1EE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1E98FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id)');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1EAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE avancement_exercice ADD CONSTRAINT FK_3F307D1E40AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1EA76ED395');
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1E89D40298');
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1EE3797A94');
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1E98FB19AE');
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1EAFC2B591');
        $this->addSql('ALTER TABLE avancement_exercice DROP FOREIGN KEY FK_3F307D1E40AEF4B9');
        $this->addSql('DROP TABLE avancement_exercice');
    }
}
