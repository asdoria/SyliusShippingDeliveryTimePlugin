<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Event\ShippingMethodMenuBuilderEvent;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ShippingMethodFormMenuBuilder
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Menu
 */
final class ShippingMethodFormMenuBuilder
{
    public const EVENT_NAME = 'asdoria_shipping_delivery_time.menu.admin.shipping_method.form';

    /**
     * @param FactoryInterface         $factory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(private FactoryInterface $factory, private EventDispatcherInterface $eventDispatcher)
    {
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     */
    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('shipping_method', $options) || !$options['shipping_method'] instanceof ShippingMethodInterface) {
            return $menu;
        }

        $menu
            ->addChild('details')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/ShippingMethod/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;

        $menu
            ->addChild('taxonomy')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/ShippingMethod/Tab/_taxonomy.html.twig')
            ->setLabel('sylius.ui.taxonomy')
        ;

        $menu
            ->addChild('shipments')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/ShippingMethod/Tab/_shipments.html.twig')
            ->setLabel('sylius.ui.shipments')
        ;

        $menu
            ->addChild('shippingSchedules')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/ShippingMethod/Tab/_shippingSchedules.html.twig')
            ->setLabel('asdoria.ui.shipping_schedules')
        ;

        $menu
            ->addChild('rules')
            ->setAttribute('template', '@AsdoriaSyliusShippingDeliveryTimePlugin/Admin/ShippingMethod/Tab/_rules.html.twig')
            ->setLabel('sylius.ui.rules')
        ;

        $this->eventDispatcher->dispatch(
            new ShippingMethodMenuBuilderEvent($this->factory, $menu, $options['shipping_method']),
            self::EVENT_NAME,
        );

        return $menu;
    }
}
