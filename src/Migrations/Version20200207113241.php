<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207113241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD pseudonyme VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, CHANGE ville ville VARCHAR(100) NOT NULL, CHANGE pseudo password VARCHAR(255) NOT NULL, CHANGE cp dp SMALLINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E91FE3BDAF ON users (pseudonyme)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_1483A5E91FE3BDAF ON users');
        $this->addSql('ALTER TABLE users DROP pseudonyme, DROP roles, CHANGE ville ville VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dp cp SMALLINT NOT NULL');
    }
}
