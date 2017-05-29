<?php

namespace FulbisMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170528234324 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fixtures (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', league_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', team1_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', team2_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', round SMALLINT NOT NULL, score1 SMALLINT NOT NULL, score2 SMALLINT NOT NULL, place VARCHAR(50) NOT NULL, time TIME NOT NULL, date DATE NOT NULL, title VARCHAR(50) NOT NULL, comments LONGTEXT NOT NULL, referee VARCHAR(50) NOT NULL, INDEX IDX_5CB9E53458AFC4DE (league_id), INDEX IDX_5CB9E534E72BCFA4 (team1_id), INDEX IDX_5CB9E534F59E604A (team2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fixtures ADD CONSTRAINT FK_5CB9E53458AFC4DE FOREIGN KEY (league_id) REFERENCES leagues (id)');
        $this->addSql('ALTER TABLE fixtures ADD CONSTRAINT FK_5CB9E534E72BCFA4 FOREIGN KEY (team1_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE fixtures ADD CONSTRAINT FK_5CB9E534F59E604A FOREIGN KEY (team2_id) REFERENCES teams (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fixtures');
    }
}
