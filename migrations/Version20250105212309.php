<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250105212309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(5) NOT NULL, flag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game (id SERIAL NOT NULL, season_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, team_id INT NOT NULL, position VARCHAR(255) DEFAULT NULL, height VARCHAR(5) DEFAULT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, country_id INT NOT NULL, draft_year VARCHAR(4) DEFAULT NULL, draft_round INT DEFAULT NULL, draft_number INT DEFAULT NULL, college VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_box_score (id SERIAL NOT NULL, game_id INT NOT NULL, player_id INT NOT NULL, minutes INT NOT NULL, points INT NOT NULL, field_goals_made INT NOT NULL, field_goals_attempted INT NOT NULL, three_pointers_made INT NOT NULL, three_pointers_attempted INT NOT NULL, free_throws_made INT NOT NULL, free_throws_attempted INT NOT NULL, rebounds_defensive INT NOT NULL, rebounds_offensive INT NOT NULL, assists INT NOT NULL, steals INT NOT NULL, blocks INT NOT NULL, turnovers INT NOT NULL, fouls INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE season (id SERIAL NOT NULL, year_from INT NOT NULL, year_to INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(10) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_box_score');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
