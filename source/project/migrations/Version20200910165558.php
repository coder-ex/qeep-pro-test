<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200910165558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistics (id BIGINT AUTO_INCREMENT NOT NULL, google_cache_id BIGINT NOT NULL, score JSON NOT NULL, reviews JSON NOT NULL, ratings JSON NOT NULL, UNIQUE INDEX UNIQ_E2D38B22A0780723 (google_cache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22A0780723 FOREIGN KEY (google_cache_id) REFERENCES google_cache (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE statistics');
    }
}
