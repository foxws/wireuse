<?php

namespace Foxws\WireUse\Navigation\Support;

use Closure;
use Foxws\WireUse\Actions\Support\ActionGroup;

class Navigation extends ActionGroup
{
    public ?string $active = null;

    public function add(string $name, ?Closure $callback = null): self
    {
        $item = new NavigationItem($this, $name);

        if ($callback instanceof Closure) {
            $callback($item);
        }

        $this->items[] = $item;

        return $this;
    }

    public function active(?string $name = null): self
    {
        $this->active = $name;

        return $this;
    }

    public function current(): ?NavigationItem
    {
        $items = $this->filter(function (NavigationItem $item) {
            if ($item->getName() === $this->active) {
                return $item;
            }

            return $item->isRoute() || $item->isFullUrl();
        });

        return collect($items)
            ->sortByDesc(fn (NavigationItem $item) => count($item->getContainers()))
            ->first();
    }
}
