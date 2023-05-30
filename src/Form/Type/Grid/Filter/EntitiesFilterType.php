<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\Grid\Filter;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class EntitiesFilterType extends AbstractType
{
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

    public function getParent(): string
    {
        return EntityType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'asdoria_shipping_delivery_time_grid_filter_entities';
    }
}
