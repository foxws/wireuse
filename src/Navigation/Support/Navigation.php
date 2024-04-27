<?php

namespace Foxws\WireUse\Navigation\Support;

use Closure;
use Foxws\WireUse\Actions\Support\ActionGroup;

class Navigation extends ActionGroup
{
    public function add(string $name, ?Closure $callback = null): self
    {
        $item = new NavigationItem($this, $name);

        if ($callback instanceof Closure) {
            $callback($item);
        }

        $this->items[] = $item;

        return $this;
    }

    public function current(): ?NavigationItem
    {
        $items = $this->filter(function (NavigationItem $item) {
            $active = $this->active ?: $item->getActive();

            if (is_bool($active)) {
                return $active;
            }

            if (is_string($active) && $item->getName() === $active) {
                return $item;
            }

            return $item->isRoute() || $item->isFullUrl();
        });

        return collect($items)
            ->sortByDesc(fn (NavigationItem $item) => count($item->getContainers()))
            ->first();
    }
}
