<?php
/**
 * Created by PhpStorm.
 * User: dclauson
 * Date: 11/23/2015
 * Time: 1:24 PM
 */

namespace Elytus\LimoncelloBundle\DependencyInjection;

class RegisterEventListenersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container){
        $container->getDefinition('json_api.controller_listener');
    }
}