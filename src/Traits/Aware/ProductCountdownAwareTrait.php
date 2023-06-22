<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ProductCountdownAwareTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits\Aware
 */
trait ProductCountdownAwareTrait
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="additional_delivery_time", nullable=true, options={"default":0})
     */
    protected int $additionalDeliveryTime = 0;

    /**
     * @return int
     */
    public function getAdditionalDeliveryTime(): int
    {
        return $this->additionalDeliveryTime;
    }

    /**
     * @param int $additionalDeliveryTime
     */
    public function setAdditionalDeliveryTime(int $additionalDeliveryTime): void
    {
        $this->additionalDeliveryTime = $additionalDeliveryTime;
    }
}
