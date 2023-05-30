<?php

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

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('asdoria_shipping_delivery_time');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $node = $rootNode->addDefaultsIfNotSet()->children();
        $node->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM);

        // Cache
        $cacheNode = $node->arrayNode('cache')->addDefaultsIfNotSet()->children();
        $cacheNode->booleanNode('enabled')->defaultFalse();
        $cacheNode->scalarNode('pool')->defaultNull();

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

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
