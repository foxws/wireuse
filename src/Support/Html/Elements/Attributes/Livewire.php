<?php

namespace Foxws\WireUse\Support\Elements\Attributes;

use Illuminate\Support\Stringable;

trait Livewire
{
    public function wireKey(string $value): static
    {
        return $this->attribute('wire:key', $value);
    }

    public function wireIgnore(bool $self = false): static
    {
        return $self
            ? $this->attribute('wire:ignore.self')
            : $this->attribute('wire:ignore');
    }

    public function wireModel(string $key, ?string $modifiers = null): static
    {
        $directive = str('wire:model')
            ->when($modifiers, fn (Stringable $str) => $str->append(".{$modifiers}"))
            ->squish();

        return $this->attribute($directive->value(), $key);
    }
}
