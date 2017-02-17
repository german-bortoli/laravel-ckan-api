<?php

namespace Germanazo\CkanApi;

use Germanazo\CkanApi\Exceptions\MethodNotImplementedException;
use Germanazo\CkanApi\Factories\RepositoryFactory;
use GuzzleHttp\Client;

/**
 * Ckan api client
 *
 * Class CkanApiClient
 * @package Germanazo\CkanApi
 */
class CkanApiClient
{
    /**
     * @var Client
     */
    protected $client;


    /**
     * Setup api client
     *
     * Client must be configured with a base_uri and and authorization headers for ckan
     *
     * CkanApiClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Build repositories
     *
     * @param string $method
     * @param mixed $arguments
     * @return mixed
     *
     * @throws MethodNotImplementedException
     */
    public function __call($method, $arguments)
    {
        $className = 'Germanazo\CkanApi\Repositories\\'.ucfirst($method).'Repository';

        if (!class_exists($className)) {
            throw new MethodNotImplementedException("Repository $method is not implemented");
        }

        return $this->repositoryFactory($className);
    }

    /**
     * Build repository
     *
     * @param $class
     * @return mixed
     */
    protected function repositoryFactory($class)
    {
        return RepositoryFactory::create($class, $this->client);
    }

}