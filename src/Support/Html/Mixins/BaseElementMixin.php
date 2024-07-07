<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Illuminate\Support\Stringable;
use Spatie\Html\BaseElement;

class BaseElementMixin
{
    public function wireKey(): mixed
    {
        return function (?string $value = null) {
            /** @var BaseElement $this */

            return $this->attribute('wire:key', $value);
        };
    }

    public function wireIgnore(): mixed
    {
        return function (?bool $self = null) {
            /** @var BaseElement $this */

            return $self
                ? $this->attribute('wire:ignore.self')
                : $this->attribute('wire:ignore');
        };
    }

    public function wireNavigate(): mixed
    {
        return function () {
            /** @var BaseElement $this */

            return $this->attribute('wire:navigate');
        };
    }

    public function wireSubmit(): mixed
    {
        return function (?string $action = null) {
            /** @var BaseElement $this */

            return $this->attributeIfNotNull($action, 'wire:submit', $action);
        };
    }

    public function wireModel(): mixed
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
