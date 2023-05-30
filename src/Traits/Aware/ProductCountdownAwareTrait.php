<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

/**
 * Trait ProductCountdownAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 */
trait ProductCountdownAwareTrait
{
    /**
     * @var int
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
