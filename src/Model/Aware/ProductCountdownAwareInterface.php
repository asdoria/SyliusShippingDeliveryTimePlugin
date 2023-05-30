<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware;


/**
 * Interface ProductCountdownAwareInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ProductCountdownAwareInterface
{
    /**
     * @return int
     */
    public function getAdditionalDeliveryTime(): int;

    /**
     * @param int $additionalDeliveryTime
     */
    public function setAdditionalDeliveryTime(int $additionalDeliveryTime): void;
}
