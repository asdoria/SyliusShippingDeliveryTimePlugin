<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Entity;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Traits\ShippingMethodTrait;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;

/**
 * Class ShippingSchedule
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Entity
 */
class ShippingSchedule implements ShippingScheduleInterface
{
    use ShippingMethodTrait;

    private ?int $id = null;

    private ?string $code = null;

    private ?int $weekday = null;

    private ?DateTimeInterface $shipAt = null;

    private ?DateTimeInterface $startsAt = null;

    private ?DateTimeInterface $endsAt = null;

    protected ?int $priority = null;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     *
     * @return void
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return int|null
     */
    public function getWeekday(): ?int
    {
        return $this->weekday;
    }

    /**
     * @param int|null $weekday
     *
     * @return void
     */
    public function setWeekday(?int $weekday): void
    {
        $this->weekday = $weekday;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getShipAt(): ?DateTimeInterface
    {
        return $this->shipAt;
    }

    /**
     * @param DateTimeInterface|null $shipAt
     *
     * @return void
     */
    public function setShipAt(?DateTimeInterface $shipAt): void
    {
        $this->shipAt = $shipAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartsAt(): ?DateTimeInterface
    {
        return $this->startsAt;
    }

    /**
     * @param DateTimeInterface|null $startsAt
     *
     * @return void
     */
    public function setStartsAt(?DateTimeInterface $startsAt): void
    {
        $this->startsAt = $startsAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndsAt(): ?DateTimeInterface
    {
        return $this->endsAt;
    }

    /**
     * @param DateTimeInterface|null $endsAt
     *
     * @return void
     */
    public function setEndsAt(?DateTimeInterface $endsAt): void
    {
        $this->endsAt = $endsAt;
    }

    /**
     * @psalm-suppress InvalidReturnType https://github.com/doctrine/collections/pull/220
     * @psalm-suppress InvalidReturnStatement https://github.com/doctrine/collections/pull/220
     */
    public function getChannels(): Collection
    {
        return $this->getShippingMethod()->getChannels();
    }

    /**
     * @param ChannelInterface $channel
     *
     * @return bool
     */
    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->getChannels()->contains($channel);
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int|null $priority
     *
     * @return void
     */
    public function setPriority(?int $priority): void
    {
        $this->priority = $priority;
    }
}
