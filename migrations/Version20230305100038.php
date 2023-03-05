<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305100038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP price');
        $this->addSql('ALTER TABLE products ADD price_id INT NOT NULL, DROP price');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD614C7E7 FOREIGN KEY (price_id) REFERENCES orders (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5AD614C7E7 ON products (price_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AD614C7E7');
        $this->addSql('DROP INDEX UNIQ_B3BA5A5AD614C7E7 ON products');
        $this->addSql('ALTER TABLE products ADD price NUMERIC(10, 2) NOT NULL, DROP price_id');
    }
}
