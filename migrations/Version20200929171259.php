<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929171259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, trickId INT DEFAULT NULL, INDEX IDX_9474526C51F6BF91 (trickId), INDEX IDX_9474526C9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, trickId INT DEFAULT NULL, INDEX IDX_C53D045F51F6BF91 (trickId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, category_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_E1D902C19D86650F (user_id_id), INDEX IDX_E1D902C19777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, trickId INT DEFAULT NULL, INDEX IDX_7CC7DA2C51F6BF91 (trickId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C51F6BF91 FOREIGN KEY (trickId) REFERENCES tricks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F51F6BF91 FOREIGN KEY (trickId) REFERENCES tricks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C19D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C19777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C51F6BF91 FOREIGN KEY (trickId) REFERENCES tricks (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C19777D11E');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C51F6BF91');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F51F6BF91');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C51F6BF91');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C19D86650F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
