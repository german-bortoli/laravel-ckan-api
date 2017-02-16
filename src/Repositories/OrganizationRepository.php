<?php

namespace Germanazo\CkanApi\Repositories;

class OrganizationRepository extends BaseRepository
{
    protected $action_name = 'organization';

    /**
     * @param array $data
     * @link http://docs.ckan.org/en/latest/api/#ckan.logic.action.get.organization_list
     *
     * @return array
     */
    public function all($data)
    {
        $defaults = [
            'sort' => 'name asc',
            'limit' => $this->per_page,
            'offset' => 0,
            'all_fields' => true,
            'include_dataset_count' => true,
            'include_extras' => false,
            'include_tags' => false,
            'include_groups' => false,
            'include_users' => false,
        ];

        $data = array_merge($defaults, $data);

        return parent::list($data);
    }
}