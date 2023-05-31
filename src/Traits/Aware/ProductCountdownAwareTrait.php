<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ProductCountdownAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 */
trait ProductCountdownAwareTrait
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="additional_delivery_time", nullable=true, options={"default":0})
     */
    protected $additionalDeliveryTime = 0;

    /**
     * @return int
     */
    public function getAdditionalDeliveryTime(): int
    {
        return $this->additionalDeliveryTime;
    }

    /**
     * @param int $additionalDeliveryTime
     */
    public function setAdditionalDeliveryTime(int $additionalDeliveryTime): void
    {
        $this->additionalDeliveryTime = $additionalDeliveryTime;
    }
}
