<?php

namespace Foxws\WireUse\Actions\Concerns;

use ArrayAccess;
use Illuminate\View\Component;
use Livewire\Component as Livewire;

trait HasComponents
{
    public function component(Component|Livewire|string|null $component = null): static
    {
        $this->component = $component;

        return $this;
    }

    public function components(ArrayAccess|array $components): static
    {
        $this->components = $components;

        return $this;
    }

    public function items(): array
    {
        return $this->value('components', []);
    }
}
