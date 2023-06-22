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
use \DateTime;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Repository\ShippingScheduleRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

/**
 * Class NextShipmentDateTimeProvider
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Provider
 */
final class NextShipmentDateTimeProvider implements NextShipmentDateTimeProviderInterface
{
    /**
     * @param ShippingScheduleRepositoryInterface $repository
     */
    public function __construct(private ShippingScheduleRepositoryInterface $repository)
    {
    }

    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     * @param DateTimeInterface|null  $at
     * @param int                     $searchDaysLimit
     *
     * @return DateTimeInterface|null
     */
    public function getNextShipmentDateTime(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $at = null, int $searchDaysLimit = 10): ?DateTimeInterface
    {
        if ($searchDaysLimit-- <= 0) {
            return null;
        }

        if (null === $at) {
            $at = new DateTime('now');
        }

        $schedule = $this->repository->findForChannelAndDate($channel, $shippingMethod, $at);
        if (null === $schedule || ShippingScheduleInterface::NO_SHIPPING === $schedule->getShipAt()) {
            // If there are no shipping at this day - check next day at loop
            return $this->getNextShipmentDateTime(
                $channel,
                $shippingMethod,
                $this->getNextDayDateFromDateTime($at),
                $searchDaysLimit
            );
        }

        /** @psalm-suppress PossiblyNullArgument */
        $nextShipmentDateTime = $this->getDateTime($at, $schedule->getShipAt());
        if ($nextShipmentDateTime <= $at) {
            // If today's shipping already was performed - search
            // next shipment date starting from tomorrow's 00:00:00
            return $this->getNextShipmentDateTime(
                $channel,
                $shippingMethod,
                $this->getNextDayDateFromDateTime($at),
                $searchDaysLimit
            );
        }

        return $nextShipmentDateTime;
    }

    /**
     * @param DateTimeInterface $date
     * @param DateTimeInterface $time
     *
     * @return DateTimeInterface
     */
    private function getDateTime(DateTimeInterface $date, DateTimeInterface $time): DateTimeInterface
    {
        $dateTimeString = $date->format(sprintf(
            'Y-m-d %s',
            $time->format('H:i')
        ));

        return DateTime::createFromFormat('Y-m-d H:i', $dateTimeString);
    }

    /**
     * @param DateTimeInterface $datetime
     *
     * @return DateTimeInterface
     */
    private function getNextDayDateFromDateTime(DateTimeInterface $datetime): DateTimeInterface
    {
        $dateString = $datetime->format('Y-m-d 24:00:00');

        return DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
    }
}
