<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Actions\Concerns\HasActive;
use Foxws\WireUse\Actions\Concerns\HasAttributes;
use Foxws\WireUse\Actions\Concerns\HasComponents;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasLivewire;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Actions\Concerns\HasState;
use Foxws\WireUse\Actions\Concerns\HasView;
use Foxws\WireUse\Support\Components\Component;

class Action extends Component
{
    use HasActive;
    use HasAttributes;
    use HasComponents;
    use HasIcon;
    use HasLivewire;
    use HasName;
    use HasRequest;
    use HasRoute;
    use HasState;
    use HasView;

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
        $item = new Action($this, $name);

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

    public function isActive(): bool
    {
        $current = $this->getContainer()?->current();

        return $current?->getName() === $this->getName();
    }

    public function getUrl(): ?string
    {
        if ($this->hasRoute()) {
            return $this->getRoute();
        }

        return $this->getRequestUrl();
    }

    public function isFullUrl(): bool
    {
        return $this->isAppUrl() && request()->fullUrlIs(
            $this->getUrl()
        );
    }

    public function useNavigate(): bool
    {
        if ($this->hasWireNavigate()) {
            return $this->getWireNavigate();
        }

        return $this->hasRoute() || $this->isAppUrl();
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
