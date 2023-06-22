<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Provider;

use DateTimeInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Webmozart\Assert\Assert;

/**
 * Class CachedNextShipmentDateTimeProvider
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Provider
 */
final class CachedNextShipmentDateTimeProvider implements NextShipmentDateTimeProviderInterface
{
    /**
     * @param NextShipmentDateTimeProviderInterface $decorated
     * @param AdapterInterface                      $cache
     */
    public function __construct(
        private NextShipmentDateTimeProviderInterface $decorated,
        private AdapterInterface $cache
    )
    {
    }

    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     * @param DateTimeInterface|null  $at
     * @param int                     $searchDaysLimit
     *
     * @return DateTimeInterface|null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getNextShipmentDateTime(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $at = null, int $searchDaysLimit = 10): ?DateTimeInterface
    {
        $channelCode = $channel->getCode();
        Assert::notNull($channelCode);
        $cacheKey = sprintf(
            'asdoria-shipping-delivery-time-%s-%s',
            $channelCode,
            $shippingMethod->getCode()
        );

        $cacheItem = $this->cache->getItem($cacheKey);
        if (!$cacheItem->isHit()) {
            $nextShipmentDateTime = $this->decorated->getNextShipmentDateTime($channel, $shippingMethod, $at, $searchDaysLimit);
            $cacheItem->set($nextShipmentDateTime);
            if (null !== $nextShipmentDateTime) {
                // Next shipment datetime become not actual at moment of shipment
                $cacheItem->expiresAt($nextShipmentDateTime);
            } else {
                // If we don't have a schedule - cache for 1 hour
                // So new schedule will be visible in 1 hour
                // after it was added via admin
                $cacheItem->expiresAfter(3600);
            }

            $this->cache->save($cacheItem);
        }

        /** @var DateTimeInterface $nextShipmentDateTime */
        $nextShipmentDateTime = $cacheItem->get();

        return $nextShipmentDateTime;
    }
}
