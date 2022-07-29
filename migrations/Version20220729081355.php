<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729081355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, packages_id INT DEFAULT NULL, user_id INT NOT NULL, date DATETIME DEFAULT NULL, status INT NOT NULL, price DOUBLE PRECISION NOT NULL, message_status TINYINT(1) DEFAULT NULL, INDEX IDX_CBE5A331CA871E03 (packages_id), INDEX IDX_CBE5A331A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, style_id INT NOT NULL, name VARCHAR(64) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(24) DEFAULT NULL, email VARCHAR(180) DEFAULT NULL, website VARCHAR(180) DEFAULT NULL, opening_hour VARCHAR(255) DEFAULT NULL, opening_day VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, longitudes DOUBLE PRECISION DEFAULT NULL, latitudes DOUBLE PRECISION DEFAULT NULL, INDEX IDX_DBEFB1EEA76ED395 (user_id), INDEX IDX_DBEFB1EEBACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, package_id INT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_472B783AF44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, establishment_id INT NOT NULL, name VARCHAR(64) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, expire_on DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_DE6867958565851 (establishment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package_type (package_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_379332E1F44CABFF (package_id), INDEX IDX_379332E1C54C8C93 (type_id), PRIMARY KEY(package_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_establishment (tag_id INT NOT NULL, establishment_id INT NOT NULL, INDEX IDX_3541C6E9BAD26311 (tag_id), INDEX IDX_3541C6E98565851 (establishment_id), PRIMARY KEY(tag_id, establishment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331CA871E03 FOREIGN KEY (packages_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE6867958565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id)');
        $this->addSql('ALTER TABLE package_type ADD CONSTRAINT FK_379332E1F44CABFF FOREIGN KEY (package_id) REFERENCES package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE package_type ADD CONSTRAINT FK_379332E1C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_establishment ADD CONSTRAINT FK_3541C6E9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_establishment ADD CONSTRAINT FK_3541C6E98565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE6867958565851');
        $this->addSql('ALTER TABLE tag_establishment DROP FOREIGN KEY FK_3541C6E98565851');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331CA871E03');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AF44CABFF');
        $this->addSql('ALTER TABLE package_type DROP FOREIGN KEY FK_379332E1F44CABFF');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEBACD6074');
        $this->addSql('ALTER TABLE tag_establishment DROP FOREIGN KEY FK_3541C6E9BAD26311');
        $this->addSql('ALTER TABLE package_type DROP FOREIGN KEY FK_379332E1C54C8C93');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A76ED395');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEA76ED395');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE package_type');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_establishment');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
