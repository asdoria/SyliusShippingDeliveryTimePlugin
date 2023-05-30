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
