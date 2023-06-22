<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Provider;

use DateTimeInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

/**
 * Interface NextShipmentDateTimeProviderInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Provider
 */
interface NextShipmentDateTimeProviderInterface
{
    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     * @param DateTimeInterface|null  $at
     * @param int                     $searchDaysLimit
     *
     * @return DateTimeInterface|null
     */
    public function getNextShipmentDateTime(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $at = null, int $searchDaysLimit = 10): ?DateTimeInterface;
}
