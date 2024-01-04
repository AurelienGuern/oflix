<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104133354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season ADD movie_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_SEASON_MOVIE FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_SEASON_MOVIE_ID ON season (movie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_SEASON_MOVIE');
        $this->addSql('DROP INDEX IDX_SEASON_MOVIE_ID ON season');
        $this->addSql('ALTER TABLE season DROP movie_id');
    }
}
