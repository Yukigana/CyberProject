<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512134915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__implant AS SELECT id, id_implant, name, price, description, type, image FROM implant');
        $this->addSql('DROP TABLE implant');
        $this->addSql('CREATE TABLE implant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_sousZone INTEGER NOT NULL, name VARCHAR(100) NOT NULL, price INTEGER NOT NULL, description CLOB NOT NULL, type VARCHAR(100) NOT NULL, image VARCHAR(100) NOT NULL, CONSTRAINT FK_5A0930A3AED82FCB FOREIGN KEY (id_sousZone) REFERENCES sous_zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO implant (id, id_sousZone, name, price, description, type, image) SELECT id, id_implant, name, price, description, type, image FROM __temp__implant');
        $this->addSql('DROP TABLE __temp__implant');
        $this->addSql('CREATE INDEX IDX_5A0930A3AED82FCB ON implant (id_sousZone)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__implant AS SELECT id, name, price, description, type, image, id_sousZone FROM implant');
        $this->addSql('DROP TABLE implant');
        $this->addSql('CREATE TABLE implant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_implant INTEGER NOT NULL, name VARCHAR(100) NOT NULL, price INTEGER NOT NULL, description CLOB NOT NULL, type VARCHAR(100) NOT NULL, image VARCHAR(100) NOT NULL, CONSTRAINT FK_5A0930A3849499D3 FOREIGN KEY (id_implant) REFERENCES sous_zone (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO implant (id, name, price, description, type, image, id_implant) SELECT id, name, price, description, type, image, id_sousZone FROM __temp__implant');
        $this->addSql('DROP TABLE __temp__implant');
        $this->addSql('CREATE INDEX IDX_5A0930A3849499D3 ON implant (id_implant)');
    }
}
