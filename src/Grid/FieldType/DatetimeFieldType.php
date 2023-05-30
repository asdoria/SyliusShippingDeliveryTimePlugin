<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Grid\FieldType;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Webmozart\Assert\Assert;

final class DatetimeFieldType implements FieldTypeInterface
{
    private DataExtractorInterface $dataExtractor;

    private TranslatorInterface $translator;

    public function __construct(
        DataExtractorInterface $dataExtractor,
        TranslatorInterface $translator
    ) {
        $this->dataExtractor = $dataExtractor;
        $this->translator = $translator;
    }

    /**
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('format', 'Y-m-d H:i:s');
        $resolver->setAllowedTypes('format', 'string');

        $resolver->setDefault('default', null);
        $resolver->setAllowedTypes('default', ['null', 'string']);
    }
}
