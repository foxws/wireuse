<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Actions\Concerns\HasAttributes;
use Foxws\WireUse\Actions\Concerns\HasComponents;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasLivewire;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Actions\Concerns\HasView;
use Foxws\WireUse\Support\Components\Component;

class Action extends Component
{
    use HasAttributes;
    use HasComponents;
    use HasIcon;
    use HasLivewire;
    use HasName;
    use HasRequest;
    use HasRoute;
    use HasView;

    public function __construct(ActionGroup|Action|null $instance = null, ?string $name = null)
    {
        $this->instance = $instance;

        $this->name = $name;
    }

    public static function make(?string $name = null, ?array $attributes = null): static
    {
        return app(static::class, compact('name', 'attributes'));
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

    public function getInstance(): ?object
    {
        return $this->value('instance');
    }

    public function getInstances(): array
    {
        if (! $this->instance) {
            return [];
        }

        return array_merge($this->instance->getInstances(), [$this->instance]);
    }

    public function getDepth(): int
    {
        if (! $this->instance) {
            return 0;
        }

        return count($this->instance->getInstances());
    }
}
