<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220902130239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_fournisseur (category_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_8105885912469DE2 (category_id), INDEX IDX_81058859670C757F (fournisseur_id), PRIMARY KEY(category_id, fournisseur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_fournisseur ADD CONSTRAINT FK_8105885912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_fournisseur ADD CONSTRAINT FK_81058859670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD fournisseur_id INT NOT NULL, ADD vendor VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD670C757F ON product (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_fournisseur DROP FOREIGN KEY FK_8105885912469DE2');
        $this->addSql('ALTER TABLE category_fournisseur DROP FOREIGN KEY FK_81058859670C757F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_fournisseur');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD670C757F');
        $this->addSql('DROP INDEX IDX_D34A04AD670C757F ON product');
        $this->addSql('ALTER TABLE product DROP fournisseur_id, DROP vendor');
    }
}
