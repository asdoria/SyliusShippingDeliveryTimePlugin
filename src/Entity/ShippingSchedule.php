<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Entity;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Traits\ShippingMethodTrait;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;

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

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getWeekday(): ?int
    {
        return $this->weekday;
    }

    public function setWeekday(?int $weekday): void
    {
        $this->weekday = $weekday;
    }

    public function getShipAt(): ?DateTimeInterface
    {
        return $this->shipAt;
    }

    public function setShipAt(?DateTimeInterface $shipAt): void
    {
        $this->shipAt = $shipAt;
    }

    public function getStartsAt(): ?DateTimeInterface
    {
        return $this->startsAt;
    }

    public function setStartsAt(?DateTimeInterface $startsAt): void
    {
        $this->startsAt = $startsAt;
    }

    public function getEndsAt(): ?DateTimeInterface
    {
        return $this->endsAt;
    }

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

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->getChannels()->contains($channel);
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): void
    {
        $this->priority = $priority;
    }
}
