<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319082557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_hp5 DROP FOREIGN KEY FK_558059B898FB19AE');
        $this->addSql('DROP TABLE exercice_hp5');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD avatar VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_hp5 (id INT AUTO_INCREMENT NOT NULL, sequence_id INT DEFAULT NULL, content_html LONGBLOB NOT NULL, INDEX IDX_558059B898FB19AE (sequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercice_hp5 ADD CONSTRAINT FK_558059B898FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP avatar');
    }
}
