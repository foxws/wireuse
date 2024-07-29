<?php

namespace Foxws\WireUse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Foxws\WireUse\WireUse
 */
class WireUse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Foxws\WireUse\WireUse::class;
    }
}
