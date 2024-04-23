<?php

namespace Foxws\WireUse\Navigation\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;

class Navigation extends Component
{
    /**
     * @var array<int, NavigationItem>
     */
    public array $items = [];

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

    public function current(?string $name = null): self
    {
        logger($name);
        // $items = collect($this->items);

        // dd($items->first()->getParent());

        return $this;
    }

    public function active(): ?NavigationItem
    {
        return null;
    }
}
