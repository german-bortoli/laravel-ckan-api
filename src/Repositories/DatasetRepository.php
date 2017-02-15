<?php

namespace Germanazo\CkanApi\Repositories;

use Germanazo\CkanApi\Exceptions\MethodNotImplementedException;

/**
 * Class DatasetRepository
 * @package Germanazo\CkanApi\Repositories
 */
class DatasetRepository extends BaseRepository
{
    protected $uri = 'rest/dataset';

    /**
     * Get all resources
     *
     * @return array
     */
    public function all()
    {
        // Override method in order to get private datasets
        return $this->responseToJson($this->client->get('api/action/package_search?include_private=True'));
    }

    public function relationships($id)
    {
        throw new MethodNotImplementedException('Method: relationships is not yet implemented');
        // rest/dataset/DATASET-REF/relationships
    }

    public function relationshipType($id)
    {
        throw new MethodNotImplementedException('Method: relationshipType is not yet implemented');
        // RELATIONSHIP-TYPE: ‘depends_on’, ‘dependency_of’, ‘derives_from’, ‘has_derivation’, ‘child_of’, ‘parent_of’, ‘links_to’, ‘linked_from’.
        // rest/dataset/DATASET-REF/RELATIONSHIP-TYPE
    }

    public function revisions()
    {
        throw new MethodNotImplementedException('Method: revisions is not yet implemented');
        // rest/dataset/DATASET-REF/revisions
    }
}