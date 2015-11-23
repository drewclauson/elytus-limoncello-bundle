<?php
/**
 * Created by PhpStorm.
 * User: dclauson
 * Date: 11/23/2015
 * Time: 1:24 PM
 */

namespace Elytus\LimoncelloBundle\DependencyInjection;

use Elytus\LimoncelloBundle\Integration\SymfonyIntegration;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterEventListenersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('json_api.controller_listener.class', ControllerListener::class);
        $container->setParameter('json_api.symfony_integration.class', SymfonyIntegration::class);

        $container->register('json_api.controller_listener', '%json_api.controller_listener.class%');
        $container->register('json_api.symfony_integration', '%json_api.symfony_integration.class%')
            ->addMethodCall('setContainer', ['@service_container']);
    }
}