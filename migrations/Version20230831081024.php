<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831081024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_menu DROP INDEX IDX_30F40084CCD7E912, ADD UNIQUE INDEX UNIQ_30F40084CCD7E912 (menu_id)');
        $this->addSql('ALTER TABLE order_menu DROP INDEX IDX_30F400848D9F6D38, ADD UNIQUE INDEX UNIQ_30F400848D9F6D38 (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_menu DROP INDEX UNIQ_30F40084CCD7E912, ADD INDEX IDX_30F40084CCD7E912 (menu_id)');
        $this->addSql('ALTER TABLE order_menu DROP INDEX UNIQ_30F400848D9F6D38, ADD INDEX IDX_30F400848D9F6D38 (order_id)');
    }
}
