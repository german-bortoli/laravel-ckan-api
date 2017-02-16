<?php

namespace Germanazo\CkanApi\Traits;

trait RestApiTrait
{
    /**
     * Get all resources
     *
     * @return array
     */
    public function search($data = [])
    {
        $this->setActionUri(__FUNCTION__);
        return $this->query($data);
    }

    /**
     * Get all resources
     *
     * @return array
     */
    public function list($data = [])
    {
        $this->setActionUri(__FUNCTION__);
        return $this->query($data);
    }

    /**
     * Create a resource
     *
     * @param array $data
     * @return array
     */
    public function create(array $data = [])
    {
        $this->setActionUri(__FUNCTION__);
        return $this->responseToJson($this->client->post($this->uri, ['json' => $data]));
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->setActionUri(__FUNCTION__);

        return $this->responseToJson($this->client->post($this->uri, [
            'json' => ['id' => $id],
        ]));
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

        $this->setActionUri(__FUNCTION__);

        return $this->query($data);
    }

    /**
     * Update a resource
     *
     * @param array $data
     * @return array
     */
    public function update(array $data = [])
    {
        $this->setActionUri(__FUNCTION__);

        return $this->responseToJson($this->client->post($this->uri, [
            'json' => $data,
        ]));
    }

    /**
     * Get a simple query
     *
     * @param array $data
     * @return mixed
     */
    protected function query($data = [])
    {
        return $this->responseToJson($this->client->get($this->uri, [
            'query' => $data,
        ]));
    }


    protected function setActionUri($action)
    {
        $this->setUri("action/{$this->action_name}_{$action}");
    }
}