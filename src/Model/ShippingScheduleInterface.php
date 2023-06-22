<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware\ShippingMethodAwareInterface;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface ShippingScheduleInterface
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Model
 */
interface ShippingScheduleInterface extends ResourceInterface, CodeAwareInterface, ShippingMethodAwareInterface
{
    public const NO_SHIPPING = null;

    public const WEEKDAY_ANY = null;

    public const WEEKDAY_SUNDAY = 0;

    public const WEEKDAY_MONDAY = 1;

    public const WEEKDAY_TUESDAY = 2;

    public const WEEKDAY_WEDNESDAY = 3;

    public const WEEKDAY_THURSDAY = 4;

    public const WEEKDAY_FRIDAY = 5;

    public const WEEKDAY_SATURDAY = 6;

    /**
     * @return int|null
     */
    public function getWeekday(): ?int;

    /**
     * @param int|null $weekday
     *
     * @return void
     */
    public function setWeekday(?int $weekday): void;

    /**
     * @return DateTimeInterface|null
     */
    public function getShipAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $shipAt
     *
     * @return void
     */
    public function setShipAt(?DateTimeInterface $shipAt): void;

    /**
     * @return DateTimeInterface|null
     */
    public function getStartsAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $startsAt
     *
     * @return void
     */
    public function setStartsAt(?DateTimeInterface $startsAt): void;

    /**
     * @return DateTimeInterface|null
     */
    public function getEndsAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $endsAt
     *
     * @return void
     */
    public function setEndsAt(?DateTimeInterface $endsAt): void;

    /**
     * @psalm-suppress InvalidReturnType https://github.com/doctrine/collections/pull/220
     * @psalm-suppress InvalidReturnStatement https://github.com/doctrine/collections/pull/220
     */
    public function getChannels(): Collection;

    /**
     * @param ChannelInterface $channel
     *
     * @return bool
     */
    public function hasChannel(ChannelInterface $channel): bool;

    /**
     * @return int|null
     */
    public function getPriority(): ?int;

    /**
     * @param int|null $priority
     *
     * @return void
     */
    public function setPriority(?int $priority): void;
}
