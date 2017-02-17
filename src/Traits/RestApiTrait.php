<?php

namespace Germanazo\CkanApi\Traits;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

trait RestApiTrait
{
    /**
     * Get all resources
     *
     * @return array
     */
    public function search($data = [])
    {
        return $this->query(__FUNCTION__, $data);
    }

    /**
     * Get all resources
     *
     * @return array
     */
    public function list($data = [])
    {
        return $this->query(__FUNCTION__, $data);
    }

    /**
     * Create a resource
     *
     * @param array $data
     * @param array $multipart
     * @return array
     */
    public function create(array $data = [])
    {
        return $this->doPostAction(__FUNCTION__, $data);
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->doPostAction(__FUNCTION__, ['id' => $id]);
    }

    /**
     * Delete a resource
     *
     * @param string $id
     * @param array $data extra parameters
     * @return mixed
     */
    public function show($id, $params = [])
    {
        $data = ['id' => $id] + $params;

        return $this->query(__FUNCTION__, $data);
    }

    /**
     * Update a resource
     *
     * @param array $data
     * @param array $multipart
     * @return array
     */
    public function update(array $data = [])
    {
        return $this->doPostAction(__FUNCTION__, $data);
    }


    /**
     * Set action url
     *
     * @param string $action
     */
    protected function setActionUri($action)
    {
        $this->setUri("action/{$this->action_name}_{$action}");
    }

    /**
     * Create or update a resource
     *
     * @param string $uri
     * @param array $data
     * @return array
     */
    protected function doPostAction($uri, array $data = [])
    {
        $this->setActionUri($uri);

        try {
            $response = $this->client->post($this->uri, ['json' => $data]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        } catch (ServerException $e) {
            $response = $e->getResponse();
        }

        return $this->responseToJson($response);
    }


    /**
     * Get a simple query
     *
     * @param array $data
     * @return mixed
     */
    protected function query($uri, $data = [])
    {
        $this->setActionUri($uri);

        try {
            $response = $this->client->get($this->uri, ['query' => $data]);
        } catch(ClientException $e) {
            $response = $e->getResponse();
        } catch(ServerException $e) {
            $response = $e->getResponse();
        }

        return $this->responseToJson($response);
    }
}