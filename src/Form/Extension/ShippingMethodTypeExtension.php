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


use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\AdditionalDeliveryTime;
use Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\ShippingScheduleType;
use Sylius\Bundle\CoreBundle\Form\Type\ChannelCollectionType;
use Sylius\Bundle\ShippingBundle\Form\Type\ShippingMethodType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class ShippingMethodTypeExtension
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Extension
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ShippingMethodTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deliveryMaxTime', NumberType::class, [
                'label'    => 'asdoria.form.shipping_method.delivery_max_time',
                'required' => false,
            ])->add('deliveryMinTime', NumberType::class, [
                'label'    => 'asdoria.form.shipping_method.delivery_min_time',
                'required' => false,
            ])->add('deliveryWeekdays', ChoiceType::class, [
                'label'    => 'asdoria.form.shipping_method.delivery_weekdays',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'asdoria.ui.weekdays.monday'    => ShippingSchedule::WEEKDAY_MONDAY,
                    'asdoria.ui.weekdays.tuesday'   => ShippingSchedule::WEEKDAY_TUESDAY,
                    'asdoria.ui.weekdays.wednesday' => ShippingSchedule::WEEKDAY_WEDNESDAY,
                    'asdoria.ui.weekdays.thursday'  => ShippingSchedule::WEEKDAY_THURSDAY,
                    'asdoria.ui.weekdays.friday'    => ShippingSchedule::WEEKDAY_FRIDAY,
                    'asdoria.ui.weekdays.saturday'  => ShippingSchedule::WEEKDAY_SATURDAY,
                    'asdoria.ui.weekdays.sunday'    => ShippingSchedule::WEEKDAY_SUNDAY,
                ]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
//                $productVariant = $event->getData();

                $event->getForm()->add('additionalDeliveryTime', ChannelCollectionType::class, [
                    'entry_type' => AdditionalDeliveryTime::class,
//                    'entry_options' => function (ChannelInterface $channel) use ($productVariant) {
//                        return [
//                            'channel' => $channel,
//                        ];
//                    },
                    'label' => 'sylius.form.variant.price',
                ]);
            })
//            ->add('additionalDeliveryTime', ChoiceType::class, [
//                'label' => 'asdoria.form.product.additional_delivery_time',
//                'required' => false
//            ])
            ->add('shippingSchedules', CollectionType::class, [
                'entry_type'   => ShippingScheduleType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'asdoria.ui.shipping_schedules',
            ]);


    }

    /**
     * Gets the extended types.
     *
     * @return string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [ShippingMethodType::class];
    }
}
