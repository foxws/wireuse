<?php

namespace Foxws\WireUse\Forms\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;
use Foxws\WireUse\Support\Components\Concerns\HasComponents;
use Foxws\WireUse\Support\Components\Concerns\HasIcon;
use Foxws\WireUse\Support\Components\Concerns\HasLivewire;
use Foxws\WireUse\Support\Components\Concerns\HasName;
use Foxws\WireUse\Support\Components\Concerns\HasRequest;
use Foxws\WireUse\Support\Components\Concerns\HasRouting;
use Foxws\WireUse\Support\Components\Concerns\HasState;

class Field extends Component
{
    use HasComponents;
    use HasIcon;
    use HasLivewire;
    use HasName;
    use HasRequest;
    use HasRouting;
    use HasState;

    public array $items = [];

    public function __construct(mixed $container = null, ?string $name = null)
    {
        $this->container = $container;

        $this->name = $name;
    }

    public static function make(?string $name = null, ?array $attributes = null): static
    {
        return app(static::class, compact('name', 'attributes'));
    }

    public function all(): array
    {
        return $this->items;
    }

    public function add(string $name, ?Closure $callback = null, ?array $attributes = null): self
    {
        $item = new Field($this, $name);

        if ($callback instanceof Closure) {
            $callback($item);
        }

        if ($attributes) {
            $item->attributes($attributes);
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

    public function getContainer(): mixed
    {
        return $this->value('container');
    }

    public function getContainers(): array
    {
        if (! $this->container) {
            return [];
        }

        return array_merge($this->container->getContainers(), [$this->container]);
    }

    public function getDepth(): int
    {
        if (! $this->container) {
            return 0;
        }

        return count($this->container->getContainers());
    }
}
