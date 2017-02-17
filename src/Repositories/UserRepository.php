<?php

namespace Germanazo\CkanApi\Repositories;

class UserRepository extends BaseRepository
{
    protected $action_name = 'user';

    /**
     * Return alist of users
     *
     * @link http://docs.ckan.org/en/latest/api/#ckan.logic.action.get.user_list
     * @param array $data
     */
    public function all(array $data = [])
    {
        $defaults = [
            'all_fields' => true,
            'limit' => $this->per_page,
            'offset' => 0,
        ];

        $data = array_merge($defaults, $data);

        return parent::list($data);
    }
}