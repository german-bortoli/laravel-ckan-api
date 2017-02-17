<?php

namespace Germanazo\CkanApi\Repositories;

use GuzzleHttp\Exception\ClientException;

class ResourceRepository extends BaseRepository
{
    protected $action_name = 'resource';

    /**
     * Search for all resources
     * @param array $data
     * @link http://docs.ckan.org/en/latest/api/#ckan.logic.action.get.resource_search
     *
     * @return array
     */
    public function all($data = [])
    {
        $defaults = [
            'limit' => $this->per_page,
            'offset' => 0,
        ];

        $data = array_merge($defaults, $data);

        return parent::search($data);
    }


    /**
     * Create a new resource
     * @param array $data
     * @return array
     */
    public function create(array $data = [])
    {
        $this->setActionUri(__FUNCTION__);

        $response = $this->client->post($this->uri, [
            'multipart' => $this->dataToMultipart($data),
        ]);

        return $this->responseToJson($response);
    }

    /**
     * Update a new resource
     * @param array $data
     * @return array
     */
    public function update(array $data = [])
    {
        $this->setActionUri(__FUNCTION__);

        $response = $this->client->post($this->uri, [
            'multipart' => $this->dataToMultipart($data),
        ]);

        return $this->responseToJson($response);
    }
}