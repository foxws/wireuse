<?php

namespace Foxws\WireUse\Support\Blade;

use Illuminate\Support\Collection;
use Illuminate\View\ComponentAttributeBag;

class BladeMixin
{
    public function cssClass(): mixed
    {
        return function (?array $values = null) {
            foreach ($values as $key => $value) {
                $key = static::classKeys($key)->first();

                /** @var ComponentAttributeBag $this */
                if (! $this->has($key)) {
                    $this->offsetSet($key, $value);
                }
            }

            return $this;
        };
    }

    public function classMerge(): mixed
    {
        return function (?array $values = null) {
            /** @var ComponentAttributeBag $this */
            $classes = static::classMerged($this, $values)
                ->merge($this->get('class'))
                ->join(' ');

            $this->offsetSet('class', $classes);

            return $this
                ->withoutClass();
        };
    }

    public function withoutWireModel(): mixed
    {
        return function () {
            /** @var ComponentAttributeBag $this */
            return $this
                ->whereDoesntStartWith('wire:model');
        };
    }

    public function mergeAttributes(): mixed
    {
        return function (?array $values = null) {
            foreach ($values as $key => $value) {
                /** @var ComponentAttributeBag $this */
                $this->offsetSet($key, $value);
            }

            return $this;
        };
    }

    public function classFor(): mixed
    {
        return function (string $key, ?string $default = null) {
            $class = static::classKeys($key)->first();

            /** @var ComponentAttributeBag $this */
            return $this->get($class, $default);
        };
    }

    public function wireModel(): mixed
    {
        return function () {
            /** @var ComponentAttributeBag $this */
            return $this->whereStartsWith('wire:model')->first();
        };
    }

    public function wireKey(): mixed
    {
        return function () {
            /** @var ComponentAttributeBag $this */
            return $this->wireModel() ?: $this->first('id') ?: $this->first('name');
        };
    }

    public static function classMerged(ComponentAttributeBag $attributeBag, ?array $values = null): Collection
    {
        $values ??= static::classAttributes($attributeBag);

        return collect($values)
            ->map(function (mixed $value, int|string $key) use ($attributeBag) {
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
        return str($attributeBag->whereStartsWith('class:'))
            ->matchAll('/class:(.*?)\=/s');
    }

    public static function classKeys(...$keys): Collection
    {
        return collect($keys)
            ->map(fn (string $value) => str($value)->startsWith('class:') ? $value : "class:{$value}");
    }
}
