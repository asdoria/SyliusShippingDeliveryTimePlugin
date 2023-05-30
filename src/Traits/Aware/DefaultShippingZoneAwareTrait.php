<?php
declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Sylius\Component\Addressing\Model\ZoneInterface;

/**
 * Trait DefaultShippingZoneAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
trait DefaultShippingZoneAwareTrait
{
    /**
     * @var ZoneInterface|null
     */
    protected ?ZoneInterface $defaultShippingZone;

    /**
     * @return ZoneInterface|null
     */
    public function getDefaultShippingZone(): ?ZoneInterface
    {
        return $this->defaultShippingZone;
    }

    /**
     * @param ZoneInterface|null $defaultShippingZone
     */
    public function setDefaultShippingZone(?ZoneInterface $defaultShippingZone): void
    {
        $this->defaultShippingZone = $defaultShippingZone;
    }
}
