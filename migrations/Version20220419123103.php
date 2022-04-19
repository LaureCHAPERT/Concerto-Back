<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419123103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE hour hour VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE genre CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE region CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE created_at created_at DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE hour hour TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE genre CHANGE created_at created_at DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE region CHANGE created_at created_at DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
