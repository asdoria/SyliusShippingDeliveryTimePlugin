<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware;


use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * Interface ShippingMethodAwareInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ShippingMethodAwareInterface
{
    /**
     * @return ShippingMethodInterface
     */
    public function getShippingMethod(): ?ShippingMethodInterface;

    /**
     * @param ShippingMethodInterface $shippingMethod
     */
    public function setShippingMethod(?ShippingMethodInterface $shippingMethod): void;
}
