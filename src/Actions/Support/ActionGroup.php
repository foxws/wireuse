<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;

class ActionGroup extends Component
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

    public function action(Action $action, ?Closure $callback = null): self
    {
        $action->container = $this;

        if ($callback instanceof Closure) {
            $callback($action);
        }

        $this->items[] = $action;

        return $this;
    }

    public function actionIf(mixed $condition, Action $action, ?Closure $callback = null): self
    {
        if (value($condition)) {
            $this->action($action, $callback);
        }

        return $this;
    }

    public function attributes(?array $attributes = null): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function active(bool|string|null $name = null): self
    {
        $this->active = $name;

        return $this;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function first(string $name): ?Action
    {
        $items = $this->filter(fn (Action $item) => $item->getName() === $name);

        return collect($items)
            ->sortByDesc(fn (Action $item) => count($item->getContainers()))
            ->first();
    }

    public function filter(Closure $callback): array
    {
        return $this->filterItems($this->items, $callback);
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
            'active' => $this->active,
            'attributes' => $this->attributes,
        ];
    }
}
