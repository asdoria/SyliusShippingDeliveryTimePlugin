<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;

final class EntitiesFilter implements FilterInterface
{
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
