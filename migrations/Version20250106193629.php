<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250106193629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_history (id SERIAL NOT NULL, team_id INT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(10) NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8C3017C296CD8AE ON team_history (team_id)');
        $this->addSql('ALTER TABLE team_history ADD CONSTRAINT FK_D8C3017C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD source_id VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE player ADD source_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD source_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team_history DROP CONSTRAINT FK_D8C3017C296CD8AE');
        $this->addSql('DROP TABLE team_history');
        $this->addSql('ALTER TABLE team DROP source_id');
        $this->addSql('ALTER TABLE player DROP source_id');
        $this->addSql('ALTER TABLE game DROP source_id');
    }
}
