<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204162030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice_line (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, module VARCHAR(255) NOT NULL, date DATE NOT NULL, hours DOUBLE PRECISION NOT NULL, class VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_D3D1D6937F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D6937F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE facture ADD month TIME NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD pdf_path VARCHAR(255) DEFAULT NULL, DROP prix, DROP prestation, DROP volume');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D6937F2DEE08');
        $this->addSql('DROP TABLE invoice_line');
        $this->addSql('ALTER TABLE facture ADD prix DOUBLE PRECISION NOT NULL, ADD prestation VARCHAR(255) NOT NULL, ADD volume DOUBLE PRECISION NOT NULL, DROP month, DROP created_at, DROP updated_at, DROP pdf_path');
    }
}
