<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305183709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE name name TINYTEXT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD fullname VARCHAR(255) NOT NULL, ADD email VARCHAR(50) NOT NULL, ADD phone VARCHAR(255) NOT NULL, CHANGE address address LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orders DROP fullname, DROP email, DROP phone, CHANGE address address TEXT NOT NULL');
    }
}
