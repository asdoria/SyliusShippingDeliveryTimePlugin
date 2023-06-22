<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Sylius\Component\Core\Model\ShippingMethodInterface;

/**
 * Class ShippingMethodMenuBuilderEvent
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Event
 */
class ShippingMethodMenuBuilderEvent extends MenuBuilderEvent
{
    /**
     * @param FactoryInterface        $factory
     * @param ItemInterface           $menu
     * @param ShippingMethodInterface $shippingMethod
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu, private ShippingMethodInterface $shippingMethod)
    {
        parent::__construct($factory, $menu);
    }

    /**
     * @return ShippingMethodInterface
     */
    public function getShippingMethod(): ShippingMethodInterface
    {
        return $this->shippingMethod;
    }
}
