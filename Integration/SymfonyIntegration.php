<?php
/**
 * Created by PhpStorm.
 * User: dclauson
 * Date: 11/19/2015
 * Time: 10:57 AM
 */

namespace Elytus\LimoncelloBundle\Integration;

use Neomerx\Limoncello\Config\Config as C;
use Neomerx\Limoncello\Contracts\IntegrationInterface;
use Elytus\LimoncelloBundle\Config\JsonApiConfig;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SymfonyIntegration extends ContainerAware implements IntegrationInterface
{

    /**
     * @var Request
     */
    private $currentRequest;

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        $config = $this->getFromContainer('json_api.config')->getConfig();
        /** @noinspection PhpUndefinedClassInspection */
        $config[C::JSON][C::JSON_URL_PREFIX] = $this->getCurrentRequest()->getSchemeAndHttpHost();

        return $config;
    }

    /**
     * @inheritdoc
     *
     * @return Response
     */
    public function createResponse($content, $statusCode, array $headers)
    {
        return new Response($content, $statusCode, $headers);
    }

    /**
     * @inheritdoc
     */
    public function getFromContainer($key)
    {
        return $this->container->get($key);
    }

    /**
     * @inheritdoc
     */
    public function setInContainer($key, $value)
    {
        $this->container->set($key, $value);
    }

    /**
     * @inheritdoc
     */
    public function hasInContainer($key)
    {
        return $this->container->has($key);
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        $content = (string)$this->getCurrentRequest()->getContent();

        return $content === '' ? null : $content;
    }

    /**
     * @inheritdoc
     *
     * @return Request
     */
    public function getCurrentRequest()
    {
        if ($this->currentRequest === null) {
            $this->currentRequest = $this->container->get('request');
        }

        return $this->currentRequest;
    }

    /**
     * @inheritdoc
     */
    public function getQueryParameters()
    {
        return $this->getCurrentRequest()->query->all();
    }

    /**
     * @inheritdoc
     */
    public function getHeader($name)
    {
        return $this->getCurrentRequest()->headers->get($name);
    }
}