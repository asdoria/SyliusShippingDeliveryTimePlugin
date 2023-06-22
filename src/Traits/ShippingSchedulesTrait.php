<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Traits;

use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ShippingSchedulesTrait
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait ShippingSchedulesTrait
{
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface", mappedBy="shippingMethod", cascade={"all"}, orphanRemoval=true)
     */
    protected Collection $shippingSchedules;

    /**
     *
     */
    public function initializeShippingSchedulesCollection(): void
    {
        $this->shippingSchedules = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getShippingSchedules(): Collection
    {
        return $this->shippingSchedules;
    }

    /**
     * @param ShippingScheduleInterface[]|Collection $shippingSchedules
     */
    public function setShippingSchedules($shippingSchedules): void
    {
        $this->shippingSchedules = $shippingSchedules;
    }

    /**
     * @param ShippingScheduleInterface $shippingSchedule
     */
    public function addShippingSchedule(ShippingScheduleInterface $shippingSchedule): void {
        if (!$this->hasShippingSchedule($shippingSchedule)) {
            $shippingSchedule->setShippingMethod($this);
            $this->shippingSchedules->add($shippingSchedule);
        }
    }

    /**
     * @param ShippingScheduleInterface $shippingSchedule
     */
    public function removeShippingSchedule(ShippingScheduleInterface $shippingSchedule): void {
        if ($this->hasShippingSchedule($shippingSchedule)) {
            $shippingSchedule->setShippingMethod(null);
            $this->shippingSchedules->removeElement($shippingSchedule);
        }
    }
    /**
     * @param ShippingScheduleInterface $shippingSchedule
     *
     * @return bool
     */
    public function hasShippingSchedule(ShippingScheduleInterface $shippingSchedule): bool
    {
        return $this->shippingSchedules->contains($shippingSchedule);
    }
}
