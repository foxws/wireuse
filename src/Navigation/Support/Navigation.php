<?php

namespace Foxws\WireUse\Navigation\Support;

use Foxws\WireUse\Support\Livewire\StateObjects\State;
use Illuminate\Support\Collection;

class Navigation extends State
{
    public array $items = [];

    public ?string $active = null;

    public function items(): Collection
    {
        return collect($this->items)
            ->map(fn (NavigationItem $item) => $item->active($item->getName() === $this->active));
    }
}
