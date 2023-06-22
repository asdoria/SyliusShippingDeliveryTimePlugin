<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\Grid\Filter;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EntitiesFilterType
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\Grid\Filter
 */
final class EntitiesFilterType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'class' => null,
                'label' => false,
                'placeholder' => 'sylius.ui.all',
            ])
        ;
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return EntityType::class;
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_shipping_delivery_time_grid_filter_entities';
    }
}
