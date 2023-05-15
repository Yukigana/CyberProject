<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511124840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage ADD COLUMN type VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__personnage AS SELECT id, name, histoire, event, description, id_sousZone FROM personnage');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('CREATE TABLE personnage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, histoire CLOB NOT NULL, event CLOB NOT NULL, description CLOB NOT NULL, id_sousZone INTEGER NOT NULL, CONSTRAINT FK_6AEA486DAED82FCB FOREIGN KEY (id_sousZone) REFERENCES sous_zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO personnage (id, name, histoire, event, description, id_sousZone) SELECT id, name, histoire, event, description, id_sousZone FROM __temp__personnage');
        $this->addSql('DROP TABLE __temp__personnage');
        $this->addSql('CREATE INDEX IDX_6AEA486DAED82FCB ON personnage (id_sousZone)');
    }
}
