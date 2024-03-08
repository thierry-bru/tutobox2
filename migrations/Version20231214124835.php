<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214124835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_hp5 ADD sequence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice_hp5 ADD CONSTRAINT FK_558059B898FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id)');
        $this->addSql('CREATE INDEX IDX_558059B898FB19AE ON exercice_hp5 (sequence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_hp5 DROP FOREIGN KEY FK_558059B898FB19AE');
        $this->addSql('DROP INDEX IDX_558059B898FB19AE ON exercice_hp5');
        $this->addSql('ALTER TABLE exercice_hp5 DROP sequence_id');
    }
}
