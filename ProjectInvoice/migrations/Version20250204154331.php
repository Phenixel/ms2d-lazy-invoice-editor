<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204154331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise_formateur (entreprise_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_70F6D9E6A4AEAFEA (entreprise_id), INDEX IDX_70F6D9E6155D8F51 (formateur_id), PRIMARY KEY(entreprise_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_formateur ADD CONSTRAINT FK_70F6D9E6A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_formateur ADD CONSTRAINT FK_70F6D9E6155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD formateur_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A2FE286F FOREIGN KEY (formateur_id_id) REFERENCES formateur (id)');
        $this->addSql('CREATE INDEX IDX_FE866410A2FE286F ON facture (formateur_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_formateur DROP FOREIGN KEY FK_70F6D9E6A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_formateur DROP FOREIGN KEY FK_70F6D9E6155D8F51');
        $this->addSql('DROP TABLE entreprise_formateur');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A2FE286F');
        $this->addSql('DROP INDEX IDX_FE866410A2FE286F ON facture');
        $this->addSql('ALTER TABLE facture DROP formateur_id_id');
    }
}
