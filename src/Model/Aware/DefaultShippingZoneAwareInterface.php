<?php
declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware;

use Sylius\Component\Addressing\Model\ZoneInterface;

/**
 * Interface DefaultShippingZoneAwareInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
interface DefaultShippingZoneAwareInterface
{
    /**
     * @return ZoneInterface|null
     */
    public function getDefaultShippingZone(): ?ZoneInterface;

    /**
     * @param ZoneInterface|null $defaultShippingZone
     */
    public function setDefaultShippingZone(?ZoneInterface $defaultShippingZone): void;
}
