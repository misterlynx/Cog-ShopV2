<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:src/Migrations/Version20200214132159.php
final class Version20200214132159 extends AbstractMigration
=======
final class Version20200214085507 extends AbstractMigration
>>>>>>> origin/thibaut:src/Migrations/Version20200214085507.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214132159.php
        $this->addSql('ALTER TABLE commandes DROP nomuser');
=======
        $this->addSql('ALTER TABLE comment ADD produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF347EFB ON comment (produit_id)');
>>>>>>> origin/thibaut:src/Migrations/Version20200214085507.php
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214132159.php
        $this->addSql('ALTER TABLE commandes ADD nomuser VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
=======
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF347EFB');
        $this->addSql('DROP INDEX IDX_9474526CF347EFB ON comment');
        $this->addSql('ALTER TABLE comment DROP produit_id');
>>>>>>> origin/thibaut:src/Migrations/Version20200214085507.php
    }
}
