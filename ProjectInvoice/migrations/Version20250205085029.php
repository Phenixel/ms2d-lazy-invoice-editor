<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205085029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture ADD invoice_inline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664106610CA78 FOREIGN KEY (invoice_inline_id) REFERENCES invoice_line (id)');
        $this->addSql('CREATE INDEX IDX_FE8664106610CA78 ON facture (invoice_inline_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664106610CA78');
        $this->addSql('DROP INDEX IDX_FE8664106610CA78 ON facture');
        $this->addSql('ALTER TABLE facture DROP invoice_inline_id');
    }
}
