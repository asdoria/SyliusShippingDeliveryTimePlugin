<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits;

use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * Trait ShippingMethodTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait ShippingMethodTrait
{
    /**
     * @var ShippingMethodInterface|null
     */
    protected ?ShippingMethodInterface $shippingMethod = null;

    /**
     * @return ShippingMethodInterface|null
     */
    public function getShippingMethod(): ?ShippingMethodInterface
    {
        return $this->shippingMethod;
    }

    /**
     * @param ShippingMethodInterface|null $shippingMethod
     */
    public function setShippingMethod(?ShippingMethodInterface $shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }
}
