<?php

namespace Germanazo\CkanApi\Repositories;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class BaseRepository
{
    /**
     * URI Api endpoint
     * @var string
     */
    protected $uri = '';

    /**
     * Per page, paginated results
     *
     * @var int
     */
    protected $per_page = 15;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Standard Ckan HTTP status codes are used to signal method outcomes.
     *
     * @var array
     */
    protected $status_codes = [
        200 => 'Ok',
        201 => 'OK and new object created (referred to in the Location header)',
        301 => 'Moved Permanently',
        400 => 'Bad Request',
        403 => 'Not Authorized',
        404 => 'Not Found',
        409 => 'Conflict (e.g. name already exists)',
        500 => 'Service Error',
    ];

    /**
     * BaseRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {

        $this->setUri($this->uri);

        $this->client = $client;
    }

    protected function setUri($uriToSet)
    {
        $uri = 'api/';
        $api_version = config('ckan_api.api_version');

        if (!empty($api_version)) {
            $uri .= $api_version;
        }

        $uri .= trim(rtrim($uriToSet, '/'), '/');

        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }
    /**
     * Get all resources
     *
     * @return array
     */
    public function all()
    {
        return $this->responseToJson($this->client->get($this->uri));
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->responseToJson($this->client->get($this->uri.'/'.$id));
    }

    /**
     * Create a resource
     *
     * @param array $data
     * @return array
     */
    public function create(array $data = [])
    {
        return $this->responseToJson($this->client->post($this->uri, ['json' => $data]));
    }

    /**
     * Update a resource
     *
     * @param array $data
     * @return array
     */
    public function update(array $data = [])
    {
        return $this->responseToJson($this->client->put($this->uri, ['json' => $data]));
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->responseToJson($this->client->delete($this->uri.'/'.$id));
    }

    /**
     * Convert response to json
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function responseToJson(ResponseInterface $response)
    {
        return json_decode((string) $response->getBody(), true);
    }


}