<?php

namespace Germanazo\CkanApi\Repositories;

class LicenseRepository extends BaseRepository
{
    protected $action_name = 'license';

    /**
     * @param array $data
     * @link http://docs.ckan.org/en/latest/api/#ckan.logic.action.get.license_list
     *
     * @return array
     */
    public function all($data)
    {
        $defaults = [];

        $data = array_merge($defaults, $data);

        return parent::list($data);
    }
}