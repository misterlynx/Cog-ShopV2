<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:src/Migrations/Version20200214112618.php
final class Version20200214112618 extends AbstractMigration
=======
final class Version20200214083725 extends AbstractMigration
>>>>>>> origin/theo:src/Migrations/Version20200214083725.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214112618.php
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(255) NOT NULL, prenom_user VARCHAR(255) NOT NULL, adress_user VARCHAR(255) NOT NULL, produit_nom VARCHAR(255) NOT NULL, produit_prix INT NOT NULL, total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
=======
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, commentaire LONGTEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
>>>>>>> origin/theo:src/Migrations/Version20200214083725.php
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20200214112618.php
        $this->addSql('DROP TABLE factures');
=======
        $this->addSql('DROP TABLE comment');
>>>>>>> origin/theo:src/Migrations/Version20200214083725.php
    }
}
