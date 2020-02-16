<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:src/Migrations/Version20200214130907.php
final class Version20200214130907 extends AbstractMigration
=======
final class Version20200214104823 extends AbstractMigration
>>>>>>> origin/thibaut:src/Migrations/Version20200214104823.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214130907.php
        $this->addSql('CREATE TABLE commandes_produit (commandes_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_EF0864778BF5C2E6 (commandes_id), INDEX IDX_EF086477F347EFB (produit_id), PRIMARY KEY(commandes_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(255) NOT NULL, prenom_user VARCHAR(255) NOT NULL, adress_user VARCHAR(255) NOT NULL, produit_nom VARCHAR(255) NOT NULL, produit_prix INT NOT NULL, total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes_produit ADD CONSTRAINT FK_EF0864778BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_produit ADD CONSTRAINT FK_EF086477F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes DROP nomproduit');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278BF5C2E6');
        $this->addSql('DROP INDEX IDX_29A5EC278BF5C2E6 ON produit');
        $this->addSql('ALTER TABLE produit DROP commandes_id');
=======
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nomproduit VARCHAR(255) NOT NULL, nomuser VARCHAR(255) NOT NULL, adresseuser VARCHAR(255) NOT NULL, status SMALLINT NOT NULL, prix NUMERIC(7, 2) NOT NULL, INDEX IDX_35D4282CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE produit ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC278BF5C2E6 ON produit (commandes_id)');
>>>>>>> origin/thibaut:src/Migrations/Version20200214104823.php
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214130907.php
        $this->addSql('DROP TABLE commandes_produit');
        $this->addSql('DROP TABLE factures');
        $this->addSql('ALTER TABLE commandes ADD nomproduit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produit ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC278BF5C2E6 ON produit (commandes_id)');
=======
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278BF5C2E6');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP INDEX IDX_29A5EC278BF5C2E6 ON produit');
        $this->addSql('ALTER TABLE produit DROP commandes_id');
>>>>>>> origin/thibaut:src/Migrations/Version20200214104823.php
    }
}
