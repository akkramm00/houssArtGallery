<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206154531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colletion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, is_favorite TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colletion_products (colletion_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_F620F08A60F5F4DC (colletion_id), INDEX IDX_F620F08A6C8A81A9 (products_id), PRIMARY KEY(colletion_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE colletion_products ADD CONSTRAINT FK_F620F08A60F5F4DC FOREIGN KEY (colletion_id) REFERENCES colletion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE colletion_products ADD CONSTRAINT FK_F620F08A6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colletion_products DROP FOREIGN KEY FK_F620F08A60F5F4DC');
        $this->addSql('ALTER TABLE colletion_products DROP FOREIGN KEY FK_F620F08A6C8A81A9');
        $this->addSql('DROP TABLE colletion');
        $this->addSql('DROP TABLE colletion_products');
    }
}
