<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits;

use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * Class ShippingMethodTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait ShippingMethodTrait
{
    /**
     * @var ShippingMethodInterface
     */
    protected $shippingMethod;

    /**
     * @return ShippingMethodInterface
     */
    public function getShippingMethod(): ?ShippingMethodInterface
    {
        return $this->shippingMethod;
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     */
    public function setShippingMethod(?ShippingMethodInterface $shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }
}
