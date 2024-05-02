<?php

namespace Foxws\WireUse\Support\Blade;

use Illuminate\Support\Collection;
use Illuminate\View\ComponentAttributeBag;

class Bladeable
{
    public static function classMerged(ComponentAttributeBag $attributeBag, ?array $values = null): Collection
    {
        $values ??= static::classAttributes($attributeBag);

        return collect($values)
            ->map(function (mixed $value = null, int|string $key) use ($attributeBag) {
                if (is_bool($value) && $value === false) {
                    return;
                }

                $key = static::classKeys(
                    is_numeric($key) ? $value : $key
                );

                return $attributeBag->get($key->first(), '');
            });
    }

    public static function classAttributes(ComponentAttributeBag $attributeBag): Collection
    {
        return str($attributeBag->whereStartsWith('class:'))->matchAll('/class:(.*?)\=/s');
    }

    public static function classKeys(...$keys): Collection
    {
        return collect($keys)
            ->map(fn (string $value) => str($value)->startsWith('class:') ? $value : "class:{$value}");
    }

    public static function sortClass(string $class = ''): string
    {
        return str($class)
            ->squish()
            ->split('/[\s,]+/')
            ->sort(fn (string $value) => str($value)->startsWith('!'))
            ->implode(' ');
    }
}
