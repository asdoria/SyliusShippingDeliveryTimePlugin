<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Provider;

use DateTimeInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

interface NextShipmentDateTimeProviderInterface
{
    public function getNextShipmentDateTime(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $at = null, int $searchDaysLimit = 10): ?DateTimeInterface;
}
