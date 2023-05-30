<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810073334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        if(!$schema->getTable('sylius_product')->hasColumn('additional_delivery_time')) {
            $this->addSql('ALTER TABLE sylius_product ADD additional_delivery_time INT DEFAULT 2');
        }

        if(!$schema->getTable('sylius_shipping_method')->hasColumn('delivery_weekdays')) {
            $this->addSql('ALTER TABLE sylius_shipping_method ADD delivery_weekdays LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD delivery_max_time INT DEFAULT 0, ADD delivery_min_time INT DEFAULT 0');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_product DROP additional_delivery_time');
        $this->addSql('ALTER TABLE sylius_shipping_method DROP delivery_weekdays, DROP delivery_max_time, DROP delivery_min_time');
    }
}
