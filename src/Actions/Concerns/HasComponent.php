<?php

namespace Foxws\WireUse\Actions\Concerns;

use Closure;
use Illuminate\View\Component;
use Livewire\Component as Livewire;

trait HasComponent
{
    public function component(Component|Livewire|Closure|string $component): static
    {
        $this->component = $component;

        return $this;
    }
}
