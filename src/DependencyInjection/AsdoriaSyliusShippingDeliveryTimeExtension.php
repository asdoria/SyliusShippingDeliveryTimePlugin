<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\DependencyInjection;

use LogicException;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

final class AsdoriaSyliusShippingDeliveryTimeExtension extends AbstractResourceExtension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        /**
         * @psalm-suppress PossiblyNullArgument
         * @psalm-var array{cache: array{enabled: bool, pool: ?string}, driver: string, resources: array}
         */
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        /** @psalm-suppress MixedArgument */
        $this->registerResources('asdoria', $config['driver'], $config['resources'], $container);

        $cacheEnabled = $config['cache']['enabled'];
        if ($cacheEnabled) {
            if (!interface_exists(AdapterInterface::class)) {
                throw new LogicException('Using cache is only supported when symfony/cache is installed.');
            }

            if (null === $config['cache']['pool']) {
                throw new LogicException('You should specify pool in order to use cache.');
            }

            $container->setAlias('asdoria_shipping_delivery_time.cache', $config['cache']['pool']);

            $loader->load('services/conditional/cache.yaml');
        }

        $container->setParameter('asdoria_shipping_delivery_time.cache.enabled', $cacheEnabled);

        $loader->load('services.yaml');
    }
}
