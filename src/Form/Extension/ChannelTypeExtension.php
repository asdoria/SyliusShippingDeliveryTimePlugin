<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\ZoneChoiceType;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelType;
use Sylius\Component\Core\Model\Scope;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ChannelTypeExtension
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Extension
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ChannelTypeExtension extends AbstractTypeExtension
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('defaultShippingZone', ZoneChoiceType::class, [
            'required'   => false,
            'label'      => 'asdoria.form.channel.shipping_zone_default',
            'zone_scope' => Scope::SHIPPING,
        ]);
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        return [
            ChannelType::class,
        ];
    }
}
