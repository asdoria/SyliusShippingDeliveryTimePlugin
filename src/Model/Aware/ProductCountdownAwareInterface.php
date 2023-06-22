<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
