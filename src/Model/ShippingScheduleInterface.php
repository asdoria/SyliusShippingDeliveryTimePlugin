<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Model;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware\ShippingMethodAwareInterface;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

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

    public function getWeekday(): ?int;

    public function setWeekday(?int $weekday): void;

    public function getShipAt(): ?DateTimeInterface;

    public function setShipAt(?DateTimeInterface $shipAt): void;

    public function getStartsAt(): ?DateTimeInterface;

    public function setStartsAt(?DateTimeInterface $startsAt): void;

    public function getEndsAt(): ?DateTimeInterface;

    public function setEndsAt(?DateTimeInterface $endsAt): void;

    /**
     * @psalm-suppress InvalidReturnType https://github.com/doctrine/collections/pull/220
     * @psalm-suppress InvalidReturnStatement https://github.com/doctrine/collections/pull/220
     */
    public function getChannels(): Collection;

    public function hasChannel(ChannelInterface $channel): bool;

    public function getPriority(): ?int;

    public function setPriority(?int $priority): void;
}
