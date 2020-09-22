<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921140903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB46B9EE8');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB46B9EE8');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C19777D11E');
        $this->addSql('DROP INDEX UNIQ_E1D902C19777D11E ON tricks');
        $this->addSql('ALTER TABLE tricks CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C19777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1D902C19777D11E ON tricks (category_id_id)');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB46B9EE8');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB46B9EE8');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB46B9EE8');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C19777D11E');
        $this->addSql('DROP INDEX UNIQ_E1D902C19777D11E ON tricks');
        $this->addSql('ALTER TABLE tricks CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C19777D11E FOREIGN KEY (category_id_id) REFERENCES category (id) ON UPDATE SET NULL ON DELETE SET NULL');
        $this->addSql('CREATE INDEX UNIQ_E1D902C19777D11E ON tricks (category_id_id)');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB46B9EE8');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES tricks (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
