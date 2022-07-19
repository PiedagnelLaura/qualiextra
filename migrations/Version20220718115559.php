<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718115559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE package_type (package_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_379332E1F44CABFF (package_id), INDEX IDX_379332E1C54C8C93 (type_id), PRIMARY KEY(package_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_establishment (tag_id INT NOT NULL, establishment_id INT NOT NULL, INDEX IDX_3541C6E9BAD26311 (tag_id), INDEX IDX_3541C6E98565851 (establishment_id), PRIMARY KEY(tag_id, establishment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE package_type ADD CONSTRAINT FK_379332E1F44CABFF FOREIGN KEY (package_id) REFERENCES package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE package_type ADD CONSTRAINT FK_379332E1C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_establishment ADD CONSTRAINT FK_3541C6E9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_establishment ADD CONSTRAINT FK_3541C6E98565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD packages_id INT DEFAULT NULL, ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331CA871E03 FOREIGN KEY (packages_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33167B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331CA871E03 ON book (packages_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33167B3B43D ON book (users_id)');
        $this->addSql('ALTER TABLE establishment ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DBEFB1EEA76ED395 ON establishment (user_id)');
        $this->addSql('ALTER TABLE package ADD establishment_id INT NOT NULL');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE6867958565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id)');
        $this->addSql('CREATE INDEX IDX_DE6867958565851 ON package (establishment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE package_type');
        $this->addSql('DROP TABLE tag_establishment');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331CA871E03');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33167B3B43D');
        $this->addSql('DROP INDEX IDX_CBE5A331CA871E03 ON book');
        $this->addSql('DROP INDEX IDX_CBE5A33167B3B43D ON book');
        $this->addSql('ALTER TABLE book DROP packages_id, DROP users_id');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEA76ED395');
        $this->addSql('DROP INDEX IDX_DBEFB1EEA76ED395 ON establishment');
        $this->addSql('ALTER TABLE establishment DROP user_id');
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE6867958565851');
        $this->addSql('DROP INDEX IDX_DE6867958565851 ON package');
        $this->addSql('ALTER TABLE package DROP establishment_id');
    }
}
