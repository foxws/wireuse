<?php

namespace Foxws\WireUse\Support\Blade\Concerns;

use Foxws\WireUse\Support\Blade\Bladeable;
use Illuminate\View\ComponentAttributeBag;

trait WithBladeable
{
    protected function registerBladeMacros(): static
    {
        ComponentAttributeBag::macro('cssClass', function (array $values = []): mixed {
            foreach ($values as $key => $value) {
                $key = app(Bladeable::class)::classKeys($key)->first();

                /** @var ComponentAttributeBag $this */
                if (! $this->has($key)) {
                    $this->offsetSet($key, $value);
                }
            }

            return $this;
        });

        ComponentAttributeBag::macro('classMerge', function (?array $values = null): mixed {
            /** @var ComponentAttributeBag $this */
            $classes = app(Bladeable::class)::classMerged($this, $values)
                ->merge($this->get('class'))
                ->join(' ');

            $this->offsetSet('class', $classes);

            return $this
                ->withoutClass();
        });

        ComponentAttributeBag::macro('withoutClass', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this
                ->whereDoesntStartWith('class:');
        });

        ComponentAttributeBag::macro('withoutWireModel', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this
                ->whereDoesntStartWith('wire:model');
        });

        ComponentAttributeBag::macro('mergeAttributes', function (array $values = []): mixed {
            foreach ($values as $key => $value) {
                /** @var ComponentAttributeBag $this */
                $this->offsetSet($key, $value);
            }

            return $this;
        });

        ComponentAttributeBag::macro('classFor', function (string $key, string $default = ''): mixed {
            /** @var ComponentAttributeBag $this */
            $class = app(Bladeable::class)::classKeys($key)->first();

            return $this->get($class, $default);
        });

        ComponentAttributeBag::macro('wireModel', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this->whereStartsWith('wire:model')->first();
        });

        ComponentAttributeBag::macro('wireKey', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this->wireModel() ?: $this->first('id') ?: $this->first('name');
        });

        return $this;
    }
}
