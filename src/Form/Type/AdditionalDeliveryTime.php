<?php

declare(strict_types=1);


namespace Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AdditionalDeliveryTime
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AdditionalDeliveryTime extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('day', NumberType::class, [
            'label'    => 'asdoria.form.product.additional_delivery_time',
            'required' => false
        ]);
    }
}
