<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Repository;

use DateTimeInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ShippingScheduleRepositoryInterface extends RepositoryInterface
{
    public function findForChannelAndDate(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $date): ?ShippingScheduleInterface;

    /**
     * @param $shippingMethodId
     *
     * @return QueryBuilder
     */
    public function createQueryBuilderByShippingMethodId($shippingMethodId): QueryBuilder;
}
