<?php

namespace Germanazo\CkanApi;

use Germanazo\CkanApi\Exceptions\MethodNotImplementedException;
use Germanazo\CkanApi\Factories\RepositoryFactory;
use Germanazo\CkanApi\Repositories\DatasetRepository;
use Germanazo\CkanApi\Repositories\GroupRepository;
use Germanazo\CkanApi\Repositories\LicenseRepository;
use Germanazo\CkanApi\Repositories\OrganizationRepository;
use Germanazo\CkanApi\Repositories\RevisionRepository;
use Germanazo\CkanApi\Repositories\TagRepository;
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
     * Build dataset repository
     *
     * return DatasetRepository
     */
    public function dataset()
    {
        return $this->repositoryFactory(DatasetRepository::class);
    }

    /**
     * Build group repository
     *
     * @return GroupRepository
     */
    public function group()
    {
        return $this->repositoryFactory(GroupRepository::class);
    }

    /**
     * Build tag repository
     *
     * @return TagRepository
     */
    public function tag()
    {
        return $this->repositoryFactory(TagRepository::class);
    }

    /**
     * Build revision repository
     *
     * @return RevisionRepository
     */
    public function revision()
    {
        return $this->repositoryFactory(RevisionRepository::class);
    }

    /**
     * Build license repository
     *
     * @return RevisionRepository
     */
    public function license()
    {
        return $this->repositoryFactory(LicenseRepository::class);
    }


    /**
     * Build organization repository
     */
    public function organization()
    {
        return $this->repositoryFactory(OrganizationRepository::class);
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