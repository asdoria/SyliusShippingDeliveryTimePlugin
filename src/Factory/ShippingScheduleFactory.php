<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Factory;

use Asdoria\SyliusShippingDeliveryTimePlugin\Factory\Model\ShippingScheduleFactoryInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * Class ShippingScheduleFactory
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Factory
 */
class ShippingScheduleFactory implements ShippingScheduleFactoryInterface
{
    /**
     * @psalm-param class-string $className
     */
    public function __construct(private string $className)
    {
    }

    /**
     * @return mixed
     */
    public function createNew()
    {
        return new $this->className();
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return ShippingScheduleInterface
     */
    public function createForShippingMethod(ShippingMethodInterface $shippingMethod): ShippingScheduleInterface
    {
        /** @var ShippingScheduleInterface $item */
        $item = $this->createNew();
        $item->setShippingMethod($shippingMethod);

        return $item;
    }
}
