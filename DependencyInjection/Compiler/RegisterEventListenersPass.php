<?php
/**
 * Created by PhpStorm.
 * User: dclauson
 * Date: 11/23/2015
 * Time: 1:24 PM
 */

namespace Elytus\LimoncelloBundle\DependencyInjection\Compiler;

use Elytus\LimoncelloBundle\EventListener\ControllerListener;
use Elytus\LimoncelloBundle\Integration\SymfonyIntegration;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterEventListenersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('json_api.controller_listener.class', ControllerListener::class);
        $container->setParameter('json_api.symfony_integration.class', SymfonyIntegration::class);

        $container->register('json_api.symfony_integration', '%json_api.symfony_integration.class%')
            ->addMethodCall('setContainer', array(new Reference('service_container')));
        $container->register('json_api.controller_listener', '%json_api.controller_listener.class%')
            ->addMethodCall('setContainer', array(new Reference('service_container')))
            ->addTag('kernel.event_listener', ['event' => 'kernel.controller', 'method' => 'onKernelController']);
    }
}