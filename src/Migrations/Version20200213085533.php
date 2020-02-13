<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213085533 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes ADD user_id INT NOT NULL, CHANGE prix prix NUMERIC(7, 2) NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_35D4282CA76ED395 ON commandes (user_id)');
        $this->addSql('ALTER TABLE produit ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC278BF5C2E6 ON produit (commandes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CA76ED395');
        $this->addSql('DROP INDEX IDX_35D4282CA76ED395 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP user_id, CHANGE prix prix VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278BF5C2E6');
        $this->addSql('DROP INDEX IDX_29A5EC278BF5C2E6 ON produit');
        $this->addSql('ALTER TABLE produit DROP commandes_id');
    }
}
