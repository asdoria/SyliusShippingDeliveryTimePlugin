<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525131753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE asdoria_shipping_schedule_channels');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asdoria_shipping_schedule_channels (schedule_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_B8EDB63CA40BC2D5 (schedule_id), INDEX IDX_B8EDB63C72F5A1AA (channel_id), PRIMARY KEY(schedule_id, channel_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE asdoria_shipping_schedule_channels ADD CONSTRAINT FK_B8EDB63C72F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_shipping_schedule_channels ADD CONSTRAINT FK_B8EDB63CA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES asdoria_shipping_schedule (id) ON DELETE CASCADE');
    }
}
