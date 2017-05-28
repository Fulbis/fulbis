<?php

namespace FulbisMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170527044057 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE leagues (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_85CE39EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', team_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_264E43A6296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', league_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_96C2225858AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, email VARCHAR(40) NOT NULL, password VARCHAR(255) NOT NULL, nombre VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE leagues ADD CONSTRAINT FK_85CE39EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225858AFC4DE FOREIGN KEY (league_id) REFERENCES leagues (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225858AFC4DE');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6296CD8AE');
        $this->addSql('ALTER TABLE leagues DROP FOREIGN KEY FK_85CE39EA76ED395');
        $this->addSql('DROP TABLE leagues');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE users');
    }
}
