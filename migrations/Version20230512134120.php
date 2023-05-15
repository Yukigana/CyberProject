<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512134120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description CLOB NOT NULL, histoire CLOB NOT NULL, image VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE asso_champion_implant (id_champion INTEGER NOT NULL, id_implant INTEGER NOT NULL, PRIMARY KEY(id_champion, id_implant), CONSTRAINT FK_AEEBFA6E15989221 FOREIGN KEY (id_champion) REFERENCES champion (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AEEBFA6E849499D3 FOREIGN KEY (id_implant) REFERENCES implant (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AEEBFA6E15989221 ON asso_champion_implant (id_champion)');
        $this->addSql('CREATE INDEX IDX_AEEBFA6E849499D3 ON asso_champion_implant (id_implant)');
        $this->addSql('CREATE TABLE implant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_implant INTEGER NOT NULL, name VARCHAR(100) NOT NULL, price INTEGER NOT NULL, description CLOB NOT NULL, type VARCHAR(100) NOT NULL, image VARCHAR(100) NOT NULL, CONSTRAINT FK_5A0930A3849499D3 FOREIGN KEY (id_implant) REFERENCES sous_zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5A0930A3849499D3 ON implant (id_implant)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE champion');
        $this->addSql('DROP TABLE asso_champion_implant');
        $this->addSql('DROP TABLE implant');
    }
}
