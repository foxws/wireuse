<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;

class ActionGroup extends Component
{
    public array $items = [];

    public static function make(): static
    {
        return app(static::class);
    }

    public function add(string $name, ?Closure $callback = null): self
    {
        $item = new Action($this, $name);

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

    public function getParent(): ?object
    {
        return null;
    }

    public function getParents(): array
    {
        return [];
    }
}
