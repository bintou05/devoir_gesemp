<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215164053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement ADD CONSTRAINT FK_516C3FAA670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE detail_approvisionnement ADD approvisionnement_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_approvisionnement ADD CONSTRAINT FK_63965C187294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE detail_approvisionnement ADD CONSTRAINT FK_63965C18AE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id)');
        $this->addSql('CREATE INDEX IDX_63965C18AE741A98 ON detail_approvisionnement (approvisionnement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement DROP FOREIGN KEY FK_516C3FAA670C757F');
        $this->addSql('ALTER TABLE detail_approvisionnement DROP FOREIGN KEY FK_63965C187294869C');
        $this->addSql('ALTER TABLE detail_approvisionnement DROP FOREIGN KEY FK_63965C18AE741A98');
        $this->addSql('DROP INDEX IDX_63965C18AE741A98 ON detail_approvisionnement');
        $this->addSql('ALTER TABLE detail_approvisionnement DROP approvisionnement_id');
    }
}
