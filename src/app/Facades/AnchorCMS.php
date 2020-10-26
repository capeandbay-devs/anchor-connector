<?php

namespace CapeAndBay\AnchorCMS\app\Facades;

use CapeAndBay\AnchorCMS\AnchorCMS as Anchor;
use Illuminate\Support\Facades\Facade;

class AnchorCMS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Anchor::class;
    }
}
