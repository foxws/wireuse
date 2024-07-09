<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Illuminate\Support\Stringable;
use Spatie\Html\BaseElement;

class BaseElementMixin
{
    public function crossorigin(): mixed
    {
        return function (?string $value = 'use-credentials') {
            /** @var BaseElement $this */

            return $this->attribute('crossorigin', $value);
        };
    }

    public function navigate(): mixed
    {
        return function (): BaseElement {
            /** @var BaseElement $this */

            return $this->attribute('wire:navigate');
        };
    }

    public function ignore(): mixed
    {
        return function (?bool $self = false): BaseElement {
            /** @var BaseElement $this */

            return $self
                ? $this->attribute('wire:ignore.self')
                : $this->attribute('wire:ignore');
        };
    }

    public function wireKey(): mixed
    {
        return function (?string $value = null): BaseElement {
            /** @var BaseElement $this */

            return $this->attribute('wire:key', $value);
        };
    }

    public function wireModel(): mixed
    {
        return function (string $key, ?string $modifiers = null): BaseElement {
            /** @var BaseElement $this */
            $directive = str('wire:model')
                ->when($modifiers, fn (Stringable $str) => $str->append(".{$modifiers}"))
                ->squish();

            return $this->attribute($directive->value(), $key);
        };
    }
}
