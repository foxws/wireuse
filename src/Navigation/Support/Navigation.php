<?php

namespace Foxws\WireUse\Navigation\Support;

use Foxws\WireUse\Support\Livewire\StateObjects\State;

class Navigation extends State
{
    public array $items = [];

    public function items(): array
    {
        return $this->items;
    }
}
