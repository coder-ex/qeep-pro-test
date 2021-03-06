<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200909082654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE google_unit (id BIGINT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, description_html LONGTEXT NOT NULL, summary VARCHAR(255) NOT NULL, installs VARCHAR(100) NOT NULL, min_installs INT NOT NULL, max_installs INT NOT NULL, score DOUBLE PRECISION NOT NULL, score_text VARCHAR(100) NOT NULL, ratings INT NOT NULL, reviews INT NOT NULL, histogram LONGBLOB DEFAULT NULL, price DOUBLE PRECISION NOT NULL, free TINYINT(1) NOT NULL, currency VARCHAR(10) NOT NULL, price_text VARCHAR(10) NOT NULL, offers_iap TINYINT(1) NOT NULL, iaprange VARCHAR(255) NOT NULL, size VARCHAR(100) NOT NULL, android_version VARCHAR(100) NOT NULL, android_version_text VARCHAR(100) NOT NULL, developer VARCHAR(100) NOT NULL, developer_id VARCHAR(255) NOT NULL, developer_email VARCHAR(255) NOT NULL, developer_website VARCHAR(255) NOT NULL, developer_address VARCHAR(255) NOT NULL, privacy_policy VARCHAR(255) NOT NULL, developer_internal_id BIGINT NOT NULL, genre VARCHAR(100) NOT NULL, genre_id VARCHAR(100) NOT NULL, family_genre VARCHAR(255) NOT NULL, family_genre_id VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, header_image VARCHAR(255) NOT NULL, screenshots LONGBLOB DEFAULT NULL, video VARCHAR(255) NOT NULL, video_image VARCHAR(255) NOT NULL, content_rating VARCHAR(100) NOT NULL, content_rating_description VARCHAR(255) NOT NULL, ad_supported TINYINT(1) NOT NULL, released VARCHAR(255) NOT NULL, updated BIGINT NOT NULL, version VARCHAR(100) NOT NULL, recent_changes VARCHAR(1000) NOT NULL, comments LONGBLOB DEFAULT NULL, editors_choice TINYINT(1) NOT NULL, app_id VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filter (id BIGINT AUTO_INCREMENT NOT NULL, keyword VARCHAR(100) NOT NULL, depth INT DEFAULT NULL, ratings TINYINT(1) DEFAULT NULL, reviews TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7FC45F1D5A93713B (keyword), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, filter_id BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8157AA0FD395B25E (filter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FD395B25E FOREIGN KEY (filter_id) REFERENCES filter (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FD395B25E');
        $this->addSql('DROP TABLE filter');
        $this->addSql('DROP TABLE google_unit');
        $this->addSql('DROP TABLE profile');
    }
}
