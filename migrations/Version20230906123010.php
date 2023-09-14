<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230906123010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company CHANGE img img VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30F40084CCD7E912 ON order_menu (menu_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30F400848D9F6D38 ON order_menu (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company CHANGE img img VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_30F40084CCD7E912 ON order_menu');
        $this->addSql('DROP INDEX UNIQ_30F400848D9F6D38 ON order_menu');
    }
}
