<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809130656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, van_id INT DEFAULT NULL, content TEXT NOT NULL, INDEX fk_reponse_van1_idx (van_id), INDEX fk_reponse_question1_idx (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description TEXT NOT NULL, img VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone CHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dessert (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description TEXT NOT NULL, img VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drink (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, van_id INT DEFAULT NULL, user_id INT DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, created_at VARCHAR(45) NOT NULL, INDEX fk_order_van1_idx (van_id), INDEX fk_order_user1_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_menu (menu_id INT NOT NULL, order_id INT NOT NULL, dessert_id INT DEFAULT NULL, dish_id INT DEFAULT NULL, drink_id INT DEFAULT NULL, INDEX fk_order_menu_dessert1_idx (dessert_id), INDEX fk_order_has_menu_menu1_idx (menu_id), INDEX fk_order_menu_dish1_idx (dish_id), INDEX fk_order_has_menu_order1_idx (order_id), INDEX fk_order_menu_drink1_idx (drink_id), PRIMARY KEY(menu_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, email VARCHAR(255) NOT NULL, phone CHAR(10) NOT NULL, password VARCHAR(60) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE van (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description TEXT NOT NULL, img VARCHAR(255) NOT NULL, phone CHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE van_place (van_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_ED9F279E8A128D90 (van_id), INDEX IDX_ED9F279EDA6A219 (place_id), PRIMARY KEY(van_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A258A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_menu ADD CONSTRAINT FK_30F40084745B52FD FOREIGN KEY (dessert_id) REFERENCES dessert (id)');
        $this->addSql('ALTER TABLE order_menu ADD CONSTRAINT FK_30F40084CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE order_menu ADD CONSTRAINT FK_30F40084148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE order_menu ADD CONSTRAINT FK_30F400848D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_menu ADD CONSTRAINT FK_30F4008436AA4BB4 FOREIGN KEY (drink_id) REFERENCES drink (id)');
        $this->addSql('ALTER TABLE van_place ADD CONSTRAINT FK_ED9F279E8A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE van_place ADD CONSTRAINT FK_ED9F279EDA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A258A128D90');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988A128D90');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_menu DROP FOREIGN KEY FK_30F40084745B52FD');
        $this->addSql('ALTER TABLE order_menu DROP FOREIGN KEY FK_30F40084CCD7E912');
        $this->addSql('ALTER TABLE order_menu DROP FOREIGN KEY FK_30F40084148EB0CB');
        $this->addSql('ALTER TABLE order_menu DROP FOREIGN KEY FK_30F400848D9F6D38');
        $this->addSql('ALTER TABLE order_menu DROP FOREIGN KEY FK_30F4008436AA4BB4');
        $this->addSql('ALTER TABLE van_place DROP FOREIGN KEY FK_ED9F279E8A128D90');
        $this->addSql('ALTER TABLE van_place DROP FOREIGN KEY FK_ED9F279EDA6A219');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE dessert');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE drink');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_menu');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE van');
        $this->addSql('DROP TABLE van_place');
    }
}
