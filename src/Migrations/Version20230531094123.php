<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531094123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        if (!$schema->hasTable('asdoria_shipping_schedule')) {
            $this->addSql('CREATE TABLE asdoria_shipping_schedule (id INT AUTO_INCREMENT NOT NULL, shipping_method_id INT NOT NULL, code VARCHAR(255) NOT NULL, weekday SMALLINT DEFAULT NULL, ship_at TIME DEFAULT NULL, starts_at DATE DEFAULT NULL, ends_at DATE DEFAULT NULL, priority INT DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_EBB6DECD77153098 (code), INDEX IDX_EBB6DECD5F7D6850 (shipping_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }
        $this->addSql('ALTER TABLE asdoria_shipping_schedule ADD CONSTRAINT FK_EBB6DECD5F7D6850 FOREIGN KEY (shipping_method_id) REFERENCES sylius_shipping_method (id)');
        $this->addSql('ALTER TABLE sylius_channel ADD defaultShippingZone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_channel ADD CONSTRAINT FK_16C8119E52CC27A8 FOREIGN KEY (defaultShippingZone_id) REFERENCES sylius_zone (id)');
        $this->addSql('CREATE INDEX IDX_16C8119E52CC27A8 ON sylius_channel (defaultShippingZone_id)');
        if(!$schema->getTable('sylius_product')->hasColumn('additional_delivery_time')) {
            $this->addSql('ALTER TABLE sylius_product ADD additional_delivery_time INT DEFAULT 0');
        }
        if (!$schema->getTable('sylius_shipping_method')->hasColumn('delivery_weekdays')) {
            $this->addSql('ALTER TABLE sylius_shipping_method ADD delivery_weekdays LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD delivery_max_time INT DEFAULT 0, ADD delivery_min_time INT DEFAULT 0, ADD additional_delivery_time LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\'');
        } else {
            $this->addSql('UPDATE sylius_shipping_method SET delivery_weekdays = "a:0:{}" WHERE delivery_weekdays IS NULL');
            $this->addSql('ALTER TABLE sylius_shipping_method CHANGE delivery_weekdays delivery_weekdays LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE asdoria_shipping_schedule');
        $this->addSql('ALTER TABLE sylius_channel DROP FOREIGN KEY FK_16C8119E52CC27A8');
        $this->addSql('DROP INDEX IDX_16C8119E52CC27A8 ON sylius_channel');
        $this->addSql('ALTER TABLE sylius_channel DROP defaultShippingZone_id');
        $this->addSql('ALTER TABLE sylius_product DROP additional_delivery_time');
        $this->addSql('ALTER TABLE sylius_shipping_method DROP delivery_weekdays, DROP delivery_max_time, DROP delivery_min_time, DROP additional_delivery_time');
    }
}
