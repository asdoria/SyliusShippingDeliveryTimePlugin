<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Repository;

use DateTimeInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

/**
 * Class ShippingScheduleRepository
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Repository
 */
class ShippingScheduleRepository extends EntityRepository implements ShippingScheduleRepositoryInterface
{
    /**
     * @psalm-suppress MixedInferredReturnType
     */
    public function findForChannelAndDate(ChannelInterface $channel, ShippingMethodInterface $shippingMethod, DateTimeInterface $date): ?ShippingScheduleInterface
    {
        /** @psalm-suppress MixedReturnStatement */
        return $this->createQueryBuilder('o')
            ->innerJoin('o.shippingMethod', 'method', 'with', 'o.shippingMethod = :shippingMethod')
            ->andWhere(':channel MEMBER OF method.channels')
            ->andWhere('(o.weekday IS NULL OR o.weekday = :weekday)')
            ->andWhere('(o.startsAt IS NULL OR o.startsAt <= :at) AND (o.endsAt IS NULL OR o.endsAt >= :at)')
            ->setParameters([
                'channel'        => $channel,
                'shippingMethod' => $shippingMethod,
                'weekday'        => $date->format('w'),
                'at'             => $date->format('Y-m-d'),
            ])
            ->addOrderBy('o.priority', 'DESC')
            ->addOrderBy('o.weekday', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $shippingMethodId
     *
     * @return QueryBuilder
     */
    public function createQueryBuilderByShippingMethodId($shippingMethodId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.shippingMethod = :shippingMethodId')
            ->setParameter('shippingMethodId', $shippingMethodId);
    }
}
