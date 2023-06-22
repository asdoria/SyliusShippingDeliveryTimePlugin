<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Helper;

use Asdoria\SyliusShippingDeliveryTimePlugin\Helper\Model\ZoneHelperInterface;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Class ZoneHelper
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Helper
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ZoneHelper implements ZoneHelperInterface
{
    /**
     * ZoneHelper constructor.
     *
     * @param RepositoryInterface $provinceRepository
     * @param RepositoryInterface $countryRepository
     */
    public function __construct(
        protected RepositoryInterface $provinceRepository,
        protected RepositoryInterface $countryRepository
    )
    {
    }

    /**
     * @param ZoneInterface $zone
     *
     * @return ProvinceInterface|null
     */
    public function getFirstProvinceFromZone(ZoneInterface $zone): ?ProvinceInterface
    {
        if ($zone->getType() !== ZoneInterface::TYPE_PROVINCE) return null;

        /** @var ZoneMemberInterface $provinceZone */
        $zoneMember = $zone->getMembers()->first();

        if (empty($zoneMember)) return null;

        return $this->provinceRepository->findOneBy(['code' => $zoneMember->getCode()]);
    }

    /**
     * @param ZoneInterface $zone
     *
     * @return CountryInterface|null
     */
    public function getFirstCountryFromZone(ZoneInterface $zone): ?CountryInterface
    {
        if ($zone->getType() !== ZoneInterface::TYPE_COUNTRY) return null;

        /** @var ZoneMemberInterface $provinceZone */
        $zoneMember = $zone->getMembers()->first();

        if (empty($zoneMember)) return null;

        return $this->countryRepository->findOneBy(['code' => $zoneMember->getCode()]);
    }
}
