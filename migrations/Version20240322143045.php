<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322143045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice CHANGE code_base code_base VARCHAR(4096) DEFAULT NULL, CHANGE code_test code_test VARCHAR(4096) DEFAULT NULL, CHANGE code_attendu code_attendu VARCHAR(4096) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice CHANGE code_base code_base LONGBLOB DEFAULT NULL, CHANGE code_test code_test LONGBLOB DEFAULT NULL, CHANGE code_attendu code_attendu LONGBLOB DEFAULT NULL');
    }
}
