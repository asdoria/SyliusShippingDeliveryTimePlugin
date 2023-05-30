<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Provider;

use DateTimeInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Webmozart\Assert\Assert;

final class CachedNextShipmentDateTimeProvider implements NextShipmentDateTimeProviderInterface
{
    private NextShipmentDateTimeProviderInterface $decorated;

    private AdapterInterface $cache;

    public function __construct(
        NextShipmentDateTimeProviderInterface $decorated,
        AdapterInterface $cache
    ) {
        $this->decorated = $decorated;
        $this->cache = $cache;
    }

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
