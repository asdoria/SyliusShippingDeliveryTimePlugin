<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Asdoria\SyliusShippingDeliveryTimePlugin\Traits\ShippingSchedulesTrait;

/**
 * Trait ShippingMethodCountdownAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 */
trait ShippingMethodCountdownAwareTrait
{
    use ShippingSchedulesTrait;

    /**
     * @var array
     */
    protected $deliveryWeekdays = [];

    /**
     * @var int|null
     */
    protected $deliveryMaxTime = 0;

    /**
     * @var int|null
     */
    protected $deliveryMinTime = 0;


    /**
     * @var array
     */
    protected $additionalDeliveryTime = [];

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
