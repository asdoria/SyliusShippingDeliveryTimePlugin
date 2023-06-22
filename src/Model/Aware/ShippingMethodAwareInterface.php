<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
