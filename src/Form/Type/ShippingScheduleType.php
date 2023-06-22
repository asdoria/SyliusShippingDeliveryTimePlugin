<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type;

use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ShippingScheduleType
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type
 */
final class ShippingScheduleType extends AbstractResourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber(null, [
                'priority' => 1
            ]))
            ->add('priority', IntegerType::class, [
                'label' => 'asdoria.form.shipping_schedule.priority',
                'required' => false,
            ])
            ->add('weekday', ChoiceType::class, [
                'label' => 'asdoria.form.shipping_schedule.weekday',
                'help' => 'asdoria.form.shipping_schedule.weekday_help',
                'choices' => [
                    'asdoria.ui.weekdays.any' => ShippingSchedule::WEEKDAY_ANY,
                    'asdoria.ui.weekdays.monday' => ShippingSchedule::WEEKDAY_MONDAY,
                    'asdoria.ui.weekdays.tuesday' => ShippingSchedule::WEEKDAY_TUESDAY,
                    'asdoria.ui.weekdays.wednesday' => ShippingSchedule::WEEKDAY_WEDNESDAY,
                    'asdoria.ui.weekdays.thursday' => ShippingSchedule::WEEKDAY_THURSDAY,
                    'asdoria.ui.weekdays.friday' => ShippingSchedule::WEEKDAY_FRIDAY,
                    'asdoria.ui.weekdays.saturday' => ShippingSchedule::WEEKDAY_SATURDAY,
                    'asdoria.ui.weekdays.sunday' => ShippingSchedule::WEEKDAY_SUNDAY,
                ],
            ])
            ->add('shipAt', TimeType::class, [
                'label' => 'asdoria.form.shipping_schedule.ship_at',
                'help' => 'asdoria.form.shipping_schedule.ship_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('startsAt', DateType::class, [
                'label' => 'asdoria.form.shipping_schedule.starts_at',
                'help' => 'asdoria.form.shipping_schedule.starts_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('endsAt', DateType::class, [
                'label' => 'asdoria.form.shipping_schedule.ends_at',
                'help' => 'asdoria.form.shipping_schedule.ends_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_shipping_delivery_time_shipping_schedule';
    }
}
