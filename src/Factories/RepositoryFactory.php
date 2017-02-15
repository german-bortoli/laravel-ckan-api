<?php

namespace Germanazo\CkanApi\Factories;

use GuzzleHttp\Client;

class RepositoryFactory
{
    public static function create($class, Client $client)
    {
        return new $class($client);
    }
}