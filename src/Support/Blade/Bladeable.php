<?php

namespace Foxws\WireUse\Support\Blade;

use Illuminate\Support\Collection;

class Bladeable
{
    public static function classSort(string $class = ''): string
    {
        return str($class)
            ->squish()
            ->split('/[\s,]+/')
            ->sort(fn (string $value) => str($value)->startsWith('!'))
            ->implode(' ');
    }

    public static function cssClassKey(...$keys): Collection
    {
        return collect($keys)
            ->map(fn (string $value) => str($value)->startsWith('class:') ? $value : "class:{$value}");
    }
}
