<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716085104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asdoria_shipping_schedule (id INT AUTO_INCREMENT NOT NULL, shipping_method_id INT NOT NULL, code VARCHAR(255) NOT NULL, weekday SMALLINT DEFAULT NULL, ship_at TIME DEFAULT NULL, starts_at DATE DEFAULT NULL, ends_at DATE DEFAULT NULL, priority INT DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_EBB6DECD77153098 (code), INDEX IDX_EBB6DECD5F7D6850 (shipping_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_shipping_schedule_channels (schedule_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_B8EDB63CA40BC2D5 (schedule_id), INDEX IDX_B8EDB63C72F5A1AA (channel_id), PRIMARY KEY(schedule_id, channel_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_shipping_schedule ADD CONSTRAINT FK_EBB6DECD5F7D6850 FOREIGN KEY (shipping_method_id) REFERENCES sylius_shipping_method (id)');
        $this->addSql('ALTER TABLE asdoria_shipping_schedule_channels ADD CONSTRAINT FK_B8EDB63CA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES asdoria_shipping_schedule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_shipping_schedule_channels ADD CONSTRAINT FK_B8EDB63C72F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_shipping_schedule_channels DROP FOREIGN KEY FK_B8EDB63CA40BC2D5');
        $this->addSql('DROP TABLE asdoria_shipping_schedule');
        $this->addSql('DROP TABLE asdoria_shipping_schedule_channels');
    }
}
