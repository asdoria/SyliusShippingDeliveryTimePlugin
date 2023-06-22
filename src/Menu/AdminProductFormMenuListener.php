<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

/**
 * Class AdminProductFormMenuListener
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Menu
 */
final class AdminProductFormMenuListener
{
    /**
     * @param ProductMenuBuilderEvent $event
     */
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('shippingCountdown')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/Product/_shippingCountdown.html.twig')
            ->setLabel('asdoria.ui.shipping_delivery_time')
        ;
    }
}
