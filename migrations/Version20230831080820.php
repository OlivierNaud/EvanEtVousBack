<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831080820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX fk_order_has_menu_order1_idx ON order_menu');
        $this->addSql('DROP INDEX fk_order_has_menu_menu1_idx ON order_menu');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX fk_order_has_menu_order1_idx ON order_menu (order_id)');
        $this->addSql('CREATE INDEX fk_order_has_menu_menu1_idx ON order_menu (menu_id)');
    }
}
