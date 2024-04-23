<?php

namespace Foxws\WireUse\Navigation\Support;

use Foxws\WireUse\Actions\Support\Action;

class NavigationItem extends Action
{
    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
