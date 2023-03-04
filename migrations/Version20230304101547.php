<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304101547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AD614C7E7');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AF2D9CAFC');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9F1D6087');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB171EB6C');
        $this->addSql('DROP TABLE orders');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A7B478B1A');
        $this->addSql('DROP INDEX UNIQ_B3BA5A5AF2D9CAFC ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A7B478B1A ON products');
        $this->addSql('DROP INDEX UNIQ_B3BA5A5AD614C7E7 ON products');
        $this->addSql('ALTER TABLE products ADD categories_id INT NOT NULL, DROP categories_id_id, DROP price_id, DROP qty_id, DROP name, DROP details');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AA21214B7 ON products (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, products_id_id INT NOT NULL, customer_id_id INT NOT NULL, INDEX IDX_E52FFDEEB171EB6C (customer_id_id), UNIQUE INDEX UNIQ_E52FFDEE9F1D6087 (products_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9F1D6087 FOREIGN KEY (products_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB171EB6C FOREIGN KEY (customer_id_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AA21214B7');
        $this->addSql('DROP INDEX IDX_B3BA5A5AA21214B7 ON products');
        $this->addSql('ALTER TABLE products ADD price_id INT NOT NULL, ADD qty_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD details VARCHAR(255) NOT NULL, CHANGE categories_id categories_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A7B478B1A FOREIGN KEY (categories_id_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD614C7E7 FOREIGN KEY (price_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AF2D9CAFC FOREIGN KEY (qty_id) REFERENCES orders (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5AF2D9CAFC ON products (qty_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A7B478B1A ON products (categories_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5AD614C7E7 ON products (price_id)');
    }
}
