<?php

namespace IAS\NewRelicLoggerBundle\DependencyInjection;

use Monolog\Logger;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('ias_new_relic_logger');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('buffer_limit')
            ->defaultValue(0)
            ->end()
            ->scalarNode('level')
            ->defaultValue(Logger::INFO)
            ->end()
        ;

        return $treeBuilder;
    }
}
