<?php

namespace Foxws\WireUse\Navigation\Support;

use Foxws\WireUse\Support\Livewire\StateObjects\State;
use Illuminate\Support\Collection;

class Navigation extends State
{
    public array $items = [];

    public ?string $state = null;

    public function items(): Collection
    {
        return collect($this->items)
            ->map(function (NavigationItem $item) {
                if (property_exists($this->getComponent(), $this->state)) {
                    $item->wireModel($this->state);
                }

                if ($item->getName() === $this->state()) {
                    $item->active();
                }

                return $item;
            });
    }

    public function state(): ?string
    {
        if (filled($this->state)) {
            return (string) $this->getComponent()->getPropertyValue($this->state);
        }

        return null;
    }
}
