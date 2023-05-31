<?php
declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Doctrine\ORM\Mapping as ORM;
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
     *
     * @ORM\ManyToOne(targetEntity="Sylius\Component\Addressing\Model\ZoneInterface")
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
