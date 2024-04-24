<?php

namespace Foxws\WireUse\Navigation\Support;

use Closure;
use Foxws\WireUse\Actions\Support\Action;

class NavigationItem extends Action
{
    public function __construct(object $parent, string $name)
    {
        $this->name($name);

        $this->parent = $parent;
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

    public function isCurrent(): bool
    {
        $current = $this->getParent()?->current();

        if ($current?->getName() === $this->getName()) {
            return true;
        }

        return $this->isActive();
    }

    public function getParent(): ?object
    {
        return $this->value('parent');
    }

    public function getParents(): array
    {
        if (! $this->parent) {
            return [];
        }

        return array_merge($this->parent->getParents(), [$this->parent]);
    }

    public function getDepth(): int
    {
        if (! $this->parent) {
            return 0;
        }

        return count($this->parent->getParents());
    }
}
