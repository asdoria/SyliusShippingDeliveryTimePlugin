<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

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
