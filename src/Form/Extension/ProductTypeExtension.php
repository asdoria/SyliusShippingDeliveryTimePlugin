<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Extension;


use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ProductTypeExtension
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Extension
 */
class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('additionalDeliveryTime', NumberType::class, [
            'label' => 'asdoria.form.product.additional_delivery_time',
            'required' => false
        ]);

    }

    /**
     * Gets the extended types.
     *
     * @return string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
