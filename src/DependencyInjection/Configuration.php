<?php

/*
 * This file is part of Asdoria shipping delivery time plugin for Sylius.
 * (c) Asdoria <pve.asdoria@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\DependencyInjection;

use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use Asdoria\SyliusShippingDeliveryTimePlugin\Factory\ShippingScheduleFactory;
use Asdoria\SyliusShippingDeliveryTimePlugin\Form\Type\ShippingScheduleType;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\ShippingScheduleInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Repository\ShippingScheduleRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Asdoria\SyliusShippingDeliveryTimePlugin\DependencyInjection
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('asdoria_sylius_shipping_delivery_time');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $node = $rootNode->addDefaultsIfNotSet()->children();
        $node->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM);

        // Cache
        $cacheNode = $node->arrayNode('cache')->addDefaultsIfNotSet()->children();
        $cacheNode->booleanNode('enabled')->defaultTrue();
        $cacheNode->scalarNode('pool')->defaultValue('app.shipping_delivery_time_cache_pool');

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     *
     * @return void
     */
    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        /**
         * @psalm-suppress MixedMethodCall
         * @psalm-suppress PossiblyUndefinedMethod
         * @psalm-suppress PossiblyNullReference
         */
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('shipping_schedule')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(ShippingSchedule::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ShippingScheduleInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(ShippingScheduleRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ShippingScheduleType::class)->end()
                                        ->scalarNode('factory')->defaultValue(ShippingScheduleFactory::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
        ;
    }
}
