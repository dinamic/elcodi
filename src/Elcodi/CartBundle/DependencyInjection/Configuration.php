<?php

/**
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author ##author_placeholder
 * @version ##version_placeholder##
 */

namespace Elcodi\CartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elcodi_purchase');

        $rootNode
            ->children()
                ->arrayNode('order')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('initial_state')
                            ->defaultValue('new')
                        ->end()
                        ->variableNode('states')
                            ->defaultValue(array(
                                'new' => array(
                                    'accepted',
                                    'pending.payment',
                                    'payment.failed',
                                ),
                                'accepted' => array(
                                    'problem',
                                    'ready.ship',
                                    'cancelled',
                                ),
                                'problem' => array(
                                    'accepted',
                                    'cancelled',
                                ),
                                'ready.ship' => array(
                                    'shipped',
                                ),
                                'shipped' => array(
                                    'returned',
                                    'delivered',
                                ),
                                'returned' => array(
                                    'shipped',
                                    'refunded',
                                    'cancelled',
                                ),
                                'delivered' => array(
                                    'ready.invoice',
                                    'returned',
                                ),
                                'ready.invoice' => array(
                                    'invoiced',
                                ),
                                'invoiced' => array(
                                    'paid',
                                ),
                                'refunded' => array(
                                    'cancelled',
                                ),
                                'cancelled' => array(
                                    'accepted',
                                ),
                                'pending.payment' => array(
                                    'accepted',
                                    'cancelled',
                                ),
                            ))
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
