<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817094242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_menu ADD id INT AUTO_INCREMENT NOT NULL, CHANGE menu_id menu_id INT DEFAULT NULL, CHANGE order_id order_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30F40084CCD7E912 ON order_menu (menu_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30F400848D9F6D38 ON order_menu (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_menu MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_30F40084CCD7E912 ON order_menu');
        $this->addSql('DROP INDEX UNIQ_30F400848D9F6D38 ON order_menu');
        $this->addSql('DROP INDEX `PRIMARY` ON order_menu');
        $this->addSql('ALTER TABLE order_menu DROP id, CHANGE menu_id menu_id INT NOT NULL, CHANGE order_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_menu ADD PRIMARY KEY (menu_id, order_id)');
    }
}
