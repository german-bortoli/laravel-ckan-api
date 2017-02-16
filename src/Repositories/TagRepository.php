<?php

namespace Germanazo\CkanApi\Repositories;

class TagRepository extends BaseRepository
{
    protected $action_name = 'tag';

    /**
     * Return a list of tags whose names contain a given string.
     * @link http://docs.ckan.org/en/latest/api/#ckan.logic.action.get.tag_list
     * @param array $data
     */
    public function all($data = [])
    {
        $defaults = [
            'all_fields' => true,
        ];

        $data = array_merge($defaults, $data);

        return parent::list($data);
    }
}