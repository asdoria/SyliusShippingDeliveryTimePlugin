<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Repository;

use DateTimeInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Interface ShippingScheduleRepositoryInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Repository
 */
interface ShippingScheduleRepositoryInterface extends RepositoryInterface
{
    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     * @param DateTimeInterface       $date
     *
     * @return ShippingScheduleInterface|null
     */
    public function findForChannelAndDate(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $date): ?ShippingScheduleInterface;

    /**
     * @param $shippingMethodId
     *
     * @return QueryBuilder
     */
    public function createQueryBuilderByShippingMethodId($shippingMethodId): QueryBuilder;
}
