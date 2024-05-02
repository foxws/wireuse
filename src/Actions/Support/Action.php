<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Support\Components\Component;
use Foxws\WireUse\Support\Components\Concerns\HasComponent;
use Foxws\WireUse\Support\Components\Concerns\HasIcon;
use Foxws\WireUse\Support\Components\Concerns\HasLabel;
use Foxws\WireUse\Support\Components\Concerns\HasLivewire;
use Foxws\WireUse\Support\Components\Concerns\HasName;
use Foxws\WireUse\Support\Components\Concerns\HasNodes;
use Foxws\WireUse\Support\Components\Concerns\HasRequest;
use Foxws\WireUse\Support\Components\Concerns\HasRouting;
use Foxws\WireUse\Support\Components\Concerns\HasState;
use Foxws\WireUse\Support\Components\Concerns\HasVisibility;

class Action extends Component
{
    use HasComponent;
    use HasIcon;
    use HasLabel;
    use HasLivewire;
    use HasName;
    use HasNodes;
    use HasRequest;
    use HasRouting;
    use HasState;
    use HasVisibility;

    public function __construct(mixed $container = null, ?string $name = null)
    {
        $this->container = $container;

        $this->name = $name;
    }

    public static function make(?string $name = null, ?array $attributes = null): static
    {
        return app(static::class, compact('name', 'attributes'));
    }

    public function add(string $name, ?Closure $callback = null, ?array $attributes = null): self
    {
        $node = new Action($this, $name);

        if ($callback instanceof Closure) {
            $callback($node);
        }

        if ($attributes) {
            $node->attributes($attributes);
        }

        $this->addNode($node);

        return $this;
    }

    public function addIf(string $name, mixed $condition = false, ?Closure $callback = null, ?array $attributes = null): self
    {
        if (value($condition)) {
            $this->add($name, $callback, $attributes);
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

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'container' => $this->container,
            'attributes' => $this->attributes,
        ];
    }
}
