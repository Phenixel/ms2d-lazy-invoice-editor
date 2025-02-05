<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204155811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_formateur DROP FOREIGN KEY FK_70F6D9E6155D8F51');
        $this->addSql('ALTER TABLE entreprise_formateur DROP FOREIGN KEY FK_70F6D9E6A4AEAFEA');
        $this->addSql('DROP TABLE entreprise_formateur');
        $this->addSql('ALTER TABLE entreprise ADD formateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('CREATE INDEX IDX_D19FA60155D8F51 ON entreprise (formateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise_formateur (entreprise_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_70F6D9E6A4AEAFEA (entreprise_id), INDEX IDX_70F6D9E6155D8F51 (formateur_id), PRIMARY KEY(entreprise_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE entreprise_formateur ADD CONSTRAINT FK_70F6D9E6155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_formateur ADD CONSTRAINT FK_70F6D9E6A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60155D8F51');
        $this->addSql('DROP INDEX IDX_D19FA60155D8F51 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP formateur_id');
    }
}
