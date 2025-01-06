<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250105224605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_box_score_game (player_box_score_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(player_box_score_id, game_id))');
        $this->addSql('CREATE INDEX IDX_7AEBACA5C31198D7 ON player_box_score_game (player_box_score_id)');
        $this->addSql('CREATE INDEX IDX_7AEBACA5E48FD905 ON player_box_score_game (game_id)');
        $this->addSql('CREATE TABLE player_box_score_player (player_box_score_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(player_box_score_id, player_id))');
        $this->addSql('CREATE INDEX IDX_52E153B7C31198D7 ON player_box_score_player (player_box_score_id)');
        $this->addSql('CREATE INDEX IDX_52E153B799E6F5DF ON player_box_score_player (player_id)');
        $this->addSql('ALTER TABLE player_box_score_game ADD CONSTRAINT FK_7AEBACA5C31198D7 FOREIGN KEY (player_box_score_id) REFERENCES player_box_score (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_box_score_game ADD CONSTRAINT FK_7AEBACA5E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_box_score_player ADD CONSTRAINT FK_52E153B7C31198D7 FOREIGN KEY (player_box_score_id) REFERENCES player_box_score (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_box_score_player ADD CONSTRAINT FK_52E153B799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C45185D02 FOREIGN KEY (away_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318C9C4C13F6 ON game (home_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C45185D02 ON game (away_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C4EC001D1 ON game (season_id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
        $this->addSql('CREATE INDEX IDX_98197A65F92F3E70 ON player (country_id)');
        $this->addSql('ALTER TABLE player_box_score DROP game_id');
        $this->addSql('ALTER TABLE player_box_score DROP player_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player_box_score_game DROP CONSTRAINT FK_7AEBACA5C31198D7');
        $this->addSql('ALTER TABLE player_box_score_game DROP CONSTRAINT FK_7AEBACA5E48FD905');
        $this->addSql('ALTER TABLE player_box_score_player DROP CONSTRAINT FK_52E153B7C31198D7');
        $this->addSql('ALTER TABLE player_box_score_player DROP CONSTRAINT FK_52E153B799E6F5DF');
        $this->addSql('DROP TABLE player_box_score_game');
        $this->addSql('DROP TABLE player_box_score_player');
        $this->addSql('ALTER TABLE player_box_score ADD game_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_box_score ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65F92F3E70');
        $this->addSql('DROP INDEX IDX_98197A65296CD8AE');
        $this->addSql('DROP INDEX IDX_98197A65F92F3E70');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C45185D02');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C4EC001D1');
        $this->addSql('DROP INDEX IDX_232B318C9C4C13F6');
        $this->addSql('DROP INDEX IDX_232B318C45185D02');
        $this->addSql('DROP INDEX IDX_232B318C4EC001D1');
    }
}
