<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Grid\FieldType;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Webmozart\Assert\Assert;

/**
 * Class DatetimeFieldType
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\Grid\FieldType
 */
final class DatetimeFieldType implements FieldTypeInterface
{
    /**
     * @param DataExtractorInterface $dataExtractor
     * @param TranslatorInterface    $translator
     */
    public function __construct(
        private DataExtractorInterface $dataExtractor,
        private TranslatorInterface $translator
    )
    {
    }

    /**
     * @param Field $field
     * @param       $data
     * @param array $options
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(Field $field, $data, array $options)
    {
        $value = $this->dataExtractor->get($field, $data);
        if (null === $value) {
            /** @psalm-suppress MixedArgument */
            return $this->translator->trans($options['default']);
        }

        Assert::isInstanceOf($value, \DateTimeInterface::class);

        /** @psalm-suppress MixedArgument */
        return $value->format($options['format']);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('format', 'Y-m-d H:i:s');
        $resolver->setAllowedTypes('format', 'string');

        $resolver->setDefault('default', null);
        $resolver->setAllowedTypes('default', ['null', 'string']);
    }
}
