<?php

namespace Germanazo\CkanApi\Facades;

use Illuminate\Support\Facades\Facade;

class CkanApi extends Facade
{
    /**
     * Get registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CkanApi';
    }
}