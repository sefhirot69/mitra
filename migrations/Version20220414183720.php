<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414183720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Address (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_client CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', postal_code INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(100) NOT NULL, province VARCHAR(100) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C2F3561DE173B1B8 (id_client), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Client (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(150) NOT NULL, surname VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Address ADD CONSTRAINT FK_C2F3561DE173B1B8 FOREIGN KEY (id_client) REFERENCES Client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Address DROP FOREIGN KEY FK_C2F3561DE173B1B8');
        $this->addSql('DROP TABLE Address');
        $this->addSql('DROP TABLE Client');
    }
}
