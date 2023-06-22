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
 * Interface ShippingMethodCountdownAwareInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ShippingMethodCountdownAwareInterface extends ShippingSchedulesAwareInterface
{
    /**
     * @return array
     */
    public function getDeliveryWeekdays(): array;

    /**
     * @param array $deliveryWeekdays
     */
    public function setDeliveryWeekdays(array $deliveryWeekdays): void;

    /**
     * @return int|null
     */
    public function getDeliveryMaxTime(): ?int;

    /**
     * @param int|null $deliveryMaxTime
     */
    public function setDeliveryMaxTime(?int $deliveryMaxTime): void;

    /**
     * @return int|null
     */
    public function getDeliveryMinTime(): ?int;

    /**
     * @param int|null $deliveryMinTime
     */
    public function setDeliveryMinTime(?int $deliveryMinTime): void;

    /**
     * @return array
     */
    public function getAdditionalDeliveryTime(): array;

    /**
     * @param array $additionalDeliveryTime
     */
    public function setAdditionalDeliveryTime(array $additionalDeliveryTime): void;
}
