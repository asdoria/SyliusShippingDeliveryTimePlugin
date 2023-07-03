<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Asdoria\SyliusShippingDeliveryTimePlugin\Traits\ShippingSchedulesTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ShippingMethodCountdownAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 */
trait ShippingMethodCountdownAwareTrait
{
    use ShippingSchedulesTrait;

    /**
     * @var array
     *
     * @ORM\Column(type="array", name="delivery_weekdays", nullable=false)
     */
    protected array $deliveryWeekdays = [];

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", name="delivery_max_time", nullable=true, options={"default":0})
     */
    protected ?int $deliveryMaxTime = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", name="delivery_min_time", nullable=true, options={"default":0})
     */
    protected ?int $deliveryMinTime = 0;


    /**
     * @var array
     *
     * @ORM\Column(type="json", name="additional_delivery_time", nullable=false)
     */
    protected array $additionalDeliveryTime = [];

    /**
     * @return array
     */
    public function getDeliveryWeekdays(): array
    {
        return $this->deliveryWeekdays;
    }

    /**
     * @param array $deliveryWeekdays
     */
    public function setDeliveryWeekdays(array $deliveryWeekdays): void
    {
        $this->deliveryWeekdays = $deliveryWeekdays;
    }

    /**
     * @return int|null
     */
    public function getDeliveryMaxTime(): ?int
    {
        return $this->deliveryMaxTime;
    }

    /**
     * @param int|null $deliveryMaxTime
     */
    public function setDeliveryMaxTime(?int $deliveryMaxTime): void
    {
        $this->deliveryMaxTime = $deliveryMaxTime;
    }

    /**
     * @return int|null
     */
    public function getDeliveryMinTime(): ?int
    {
        return $this->deliveryMinTime;
    }

    /**
     * @param int|null $deliveryMinTime
     */
    public function setDeliveryMinTime(?int $deliveryMinTime): void
    {
        $this->deliveryMinTime = $deliveryMinTime;
    }

    /**
     * @return array
     */
    public function getAdditionalDeliveryTime(): array
    {
        return $this->additionalDeliveryTime;
    }

    /**
     * @param array $additionalDeliveryTime
     */
    public function setAdditionalDeliveryTime(array $additionalDeliveryTime): void
    {
        $this->additionalDeliveryTime = $additionalDeliveryTime;
    }
}
