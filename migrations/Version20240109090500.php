<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109090500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting ADD person_id INT NOT NULL, ADD movie_id INT NOT NULL');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA508F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_D11BBA50217BBB47 ON casting (person_id)');
        $this->addSql('CREATE INDEX IDX_D11BBA508F93B6FC ON casting (movie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D11BBA50217BBB478F93B6FC57698A6A ON casting (person_id, movie_id, role)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50217BBB47');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA508F93B6FC');
        $this->addSql('DROP INDEX IDX_D11BBA50217BBB47 ON casting');
        $this->addSql('DROP INDEX IDX_D11BBA508F93B6FC ON casting');
        $this->addSql('DROP INDEX UNIQ_D11BBA50217BBB478F93B6FC57698A6A ON casting');
        $this->addSql('ALTER TABLE casting DROP person_id, DROP movie_id');
    }
}
