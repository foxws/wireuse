<?php

namespace Foxws\WireUse\Navigation\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;

class Navigation extends Component
{
    public array $items = [];

    public ?string $active = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public function add(string $name, ?Closure $callback = null): self
    {
        $item = new NavigationItem($this, $name);

        if ($callback instanceof Closure) {
            $callback($item);
        }

        $this->items[] = $item;

        return $this;
    }

    public function addIf(mixed $condition, string $name, ?Closure $callback = null): self
    {
        if (value($condition)) {
            $this->add($name, $callback);
        }

        return $this;
    }

    public function active(?string $name = null): self
    {
        $this->active = $name;

        return $this;
    }

    public function filter(Closure $callback): array
    {
        return $this->filterItems($this->items, $callback);
    }

    public function current(): ?NavigationItem
    {
        $items = $this->filter(function (NavigationItem $item) {
            if ($item->getName() === $this->getActive()) {
                return $item;
            }

            return $item->isActive();
        });

        return collect($items)
            ->sortByDesc(fn (NavigationItem $item) => count($item->getParents()))
            ->first();
    }

    protected function filterItems(array $items, Closure $callback): array
    {
        $filtered = [];

        foreach ($items as $item) {
            if ($callback($item)) {
                $filtered[] = $item;
            }

            foreach ($this->filterItems([], $callback) as $item) {
                $filtered[] = $item;
            }
        }

        return $filtered;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function getParent(): ?object
    {
        return null;
    }

    public function getParents(): array
    {
        return [];
    }
}
