<?php

/*
 * This file is part of Asdoria' menu bundle for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Factory\Model;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * Interface ShippingScheduleFactoryInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Factory\Model
 */
interface ShippingScheduleFactoryInterface extends FactoryInterface
{
    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return ShippingScheduleInterface
     */
    public function createForShippingMethod(ShippingMethodInterface $shippingMethod): ShippingScheduleInterface;
}
