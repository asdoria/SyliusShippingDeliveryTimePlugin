<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;

/**
 * Class EntitiesFilter
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Grid\Filter
 */
final class EntitiesFilter implements FilterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param string              $name
     * @param                     $data
     * @param array               $options
     *
     * @return void
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (empty($data)) {
            return;
        }

        $expressionBuilder = $dataSource->getExpressionBuilder();

        /** @psalm-suppress MixedArgument */
        $dataSource->restrict($expressionBuilder->equals($options['field'], $data));
    }
}
