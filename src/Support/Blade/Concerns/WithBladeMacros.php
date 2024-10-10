<?php

namespace Foxws\WireUse\Support\Blade\Concerns;

use Foxws\WireUse\Support\Blade\Bladeable;
use Illuminate\View\ComponentAttributeBag;

trait WithBladeMacros
{
    protected function cssClass(): void
    {
        ComponentAttributeBag::macro('cssClass', function (array $values = []): mixed {
            foreach ($values as $key => $value) {
                $key = Bladeable::classKeys($key)->first();

                /** @var ComponentAttributeBag $this */
                if (! $this->has($key)) {
                    $this->offsetSet($key, $value);
                }
            }

            return $this;
        });
    }

    protected function classMerge(): void
    {
        ComponentAttributeBag::macro('classMerge', function (?array $values = null): mixed {
            /** @var ComponentAttributeBag $this */
            $classes = Bladeable::classMerged($this, $values)
                ->merge($this->get('class'))
                ->join(' ');

            $this->offsetSet('class', $classes);

            return $this
                ->withoutClass();
        });
    }

    protected function withoutClass(): void
    {
        ComponentAttributeBag::macro('withoutClass', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this
                ->whereDoesntStartWith('class:');
        });
    }

    protected function withoutWireModel(): void
    {
        ComponentAttributeBag::macro('withoutWireModel', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this
                ->whereDoesntStartWith('wire:model');
        });
    }

    protected function mergeAttributes(): void
    {
        ComponentAttributeBag::macro('mergeAttributes', function (array $values = []): mixed {
            foreach ($values as $key => $value) {
                /** @var ComponentAttributeBag $this */
                $this->offsetSet($key, $value);
            }

            return $this;
        });
    }

    protected function classFor(): void
    {
        ComponentAttributeBag::macro('classFor', function (string $key, string $default = ''): mixed {
            /** @var ComponentAttributeBag $this */
            $class = Bladeable::classKeys($key)->first();

            return $this->get($class, $default);
        });

    }

    protected function wireModel(): void
    {
        ComponentAttributeBag::macro('wireModel', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this->whereStartsWith('wire:model')->first();
        });
    }

    protected function wireKey(): void
    {
        ComponentAttributeBag::macro('wireKey', function (): mixed {
            /** @var ComponentAttributeBag $this */
            return $this->wireModel() ?: $this->first('id') ?: $this->first('name');
        });
    }
}
