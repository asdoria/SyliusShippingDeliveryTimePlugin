<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware;


use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Class ShippingSchedulesAwareInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ShippingSchedulesAwareInterface
{
    /**
     *
     */
    public function initializeShippingSchedulesCollection(): void;

    /**
     * @return ShippingScheduleInterface[]|Collection
     */
    public function getShippingSchedules(): Collection;

    /**
     * @param ShippingScheduleInterface[]|Collection $shippingSchedules
     */
    public function setShippingSchedules($shippingSchedules): void;

    /**
     * @param ShippingScheduleInterface $shippingSchedule
     */
    public function addShippingSchedule(ShippingScheduleInterface $shippingSchedule): void;

    /**
     * @param ShippingScheduleInterface $shippingSchedule
     */
    public function removeShippingSchedule(ShippingScheduleInterface $shippingSchedule): void;

    /**
     * @param ShippingScheduleInterface $shippingSchedule
     *
     * @return bool
     */
    public function hasShippingSchedule(ShippingScheduleInterface $shippingSchedule): bool;
}
