<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215163729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement ADD fournisseur_id INT NOT NULL, DROP fournisseur, DROP relation');
        $this->addSql('ALTER TABLE approvisionnement ADD CONSTRAINT FK_516C3FAA670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_516C3FAA670C757F ON approvisionnement (fournisseur_id)');
        $this->addSql('ALTER TABLE detail_approvisionnement ADD CONSTRAINT FK_63965C187294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement DROP FOREIGN KEY FK_516C3FAA670C757F');
        $this->addSql('DROP INDEX IDX_516C3FAA670C757F ON approvisionnement');
        $this->addSql('ALTER TABLE approvisionnement ADD fournisseur VARCHAR(255) NOT NULL, ADD relation VARCHAR(255) NOT NULL, DROP fournisseur_id');
        $this->addSql('ALTER TABLE detail_approvisionnement DROP FOREIGN KEY FK_63965C187294869C');
    }
}
