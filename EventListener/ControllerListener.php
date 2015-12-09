<?php

namespace Elytus\LimoncelloBundle\EventListener;

use Elytus\LimoncelloBundle\Controller\JsonApiController;
use Neomerx\Limoncello\Http\AppServiceProviderTrait;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ControllerListener
{
    use AppServiceProviderTrait;
    use ContainerAwareTrait;

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
