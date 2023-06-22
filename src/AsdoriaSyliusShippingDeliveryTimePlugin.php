<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AsdoriaSyliusShippingDeliveryTimePlugin
 * @package Asdoria\SyliusShippingDeliveryTimePlugin
 */
class AsdoriaSyliusShippingDeliveryTimePlugin extends Bundle
{
    use SyliusPluginTrait;
}
