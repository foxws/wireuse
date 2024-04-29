<?php

namespace Foxws\WireUse\Forms\Support;

use Closure;
use Foxws\WireUse\Actions\Support\Actions;
use Foxws\WireUse\Support\Components\Component;

class Schema extends Component
{
    public ?string $name = null;

    public ?string $active = null;

    public array $items = [];

    public static function make(?string $name = null, array $attributes = []): static
    {
        return app(static::class, compact('name', 'attributes'));
    }

    public function add(string $name, ?Closure $callback = null): self
    {
        $item = new Field($this, $name);

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

    public function actions(Actions $actions): self
    {
        // TODO

        return $this;
    }

    public function attributes(?array $attributes = null): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function filter(Closure $callback): array
    {
        return $this->filterItems($this->items, $callback);
    }

    public function getContainer(): ?object
    {
        return null;
    }

    public function getContainers(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'attributes' => $this->attributes,
        ];
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
}
