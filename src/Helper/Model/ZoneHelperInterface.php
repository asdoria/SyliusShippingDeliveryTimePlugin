<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Helper\Model;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;

/**
 * Interface ZoneHelperInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Helper\Model
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
interface ZoneHelperInterface
{
    /**
     * @param ZoneInterface $zone
     *
     * @return ProvinceInterface|null
     */
    public function getFirstProvinceFromZone(ZoneInterface $zone): ?ProvinceInterface;

    /**
     * @param ZoneInterface $zone
     *
     * @return CountryInterface|null
     */
    public function getFirstCountryFromZone(ZoneInterface $zone): ?CountryInterface;
}
