<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Illuminate\Support\Stringable;
use Spatie\Html\BaseElement;

class BaseElementMixin
{
    public function wireKey()
    {
        return function (string $value) {
            /** @var BaseElement $this */

            return $this->attribute('wire:key', $value);
        };
    }

    public function wireIgnore()
    {
        return function (bool $self = false) {
            /** @var BaseElement $this */

            return $self
                ? $this->attribute('wire:ignore.self')
                : $this->attribute('wire:ignore');
        };
    }

    public function wireModel()
    {
        return function (string $key, ?string $modifiers = null) {
            /** @var BaseElement $this */
            $directive = str('wire:model')
                ->when($modifiers, fn (Stringable $str) => $str->append(".{$modifiers}"))
                ->squish();

            return $this->attribute($directive->value(), $key);
        };
    }
}
