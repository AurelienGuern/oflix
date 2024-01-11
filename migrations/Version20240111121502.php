<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111121502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie CHANGE rating rating NUMERIC(2, 1) DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE movie_id movie_id INT NOT NULL, CHANGE reactions reactions LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie CHANGE rating rating NUMERIC(2, 1) NOT NULL');
        $this->addSql('ALTER TABLE review CHANGE movie_id movie_id INT DEFAULT NULL, CHANGE reactions reactions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }
}
