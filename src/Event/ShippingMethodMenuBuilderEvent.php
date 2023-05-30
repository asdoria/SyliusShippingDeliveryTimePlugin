<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Sylius\Component\Core\Model\ShippingMethodInterface;

class ShippingMethodMenuBuilderEvent extends MenuBuilderEvent
{
    public function __construct(FactoryInterface $factory, ItemInterface $menu, private ShippingMethodInterface $shippingMethod)
    {
        parent::__construct($factory, $menu);
    }

    public function getShippingMethod(): ShippingMethodInterface
    {
        return $this->shippingMethod;
    }
}
