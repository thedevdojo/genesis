<?php

namespace Devdojo\Genesis;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Devdojo\Genesis\Skeleton\SkeletonClass
 */
class GenesisFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'genesis';
    }
}
