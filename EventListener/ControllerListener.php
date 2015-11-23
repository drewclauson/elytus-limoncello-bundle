<?php

namespace Elytus\LimoncelloBundle\EventListener;

use Neomerx\Limoncello\Http\AppServiceProviderTrait;
use Elytus\LimoncelloBundle\Controller\JsonApiController;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ControllerListener extends ContainerAware
{
    use AppServiceProviderTrait;

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_subclass_of($controller[0], JsonApiController::class)) {
            /** @var JsonApiController $jsonApiController */
            $jsonApiController = $controller[0];
            $integration = $this->container->get('json_api.symfony_integration');

            $this->registerResponses($integration);
            $this->registerCodecMatcher($integration);
            $this->registerExceptionThrower($integration);

            $jsonApiController->callInitJsonApiSupport($integration);
        }

    }
}