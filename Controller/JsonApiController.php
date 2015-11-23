<?php
/**
 * Created by PhpStorm.
 * User: dclauson
 * Date: 11/20/2015
 * Time: 1:21 PM
 */

namespace Elytus\LimoncelloBundle\Controller;

use Neomerx\Limoncello\Http\JsonApiTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class JsonApiController extends Controller
{
    use JsonApiTrait;

    public function callInitJsonApiSupport($integration)
    {
        $this->integration = $integration;
        $this->initJsonApiSupport($integration);
    }
}