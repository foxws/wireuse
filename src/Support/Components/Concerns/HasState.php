<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasState
{
    public function state(?string $state = null): static
    {
        $this->state = $state;

        return $this;
    }

    public function default(mixed $default = null): static
    {
        $this->default = $default;

        return $this;
    }

    public function active(bool|string|null $active = null): static
    {
        $this->active = $active;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->value('state');
    }

    public function hasState(): bool
    {
        return $this->offsetExists('state');
    }

    public function getDefault(): mixed
    {
        return $this->value('default');
    }

    public function hasDefault(): bool
    {
        return $this->offsetExists('default');
    }

    public function getActive(): mixed
    {
        return $this->value('active');
    }

    public function hasActive(): mixed
    {
        return $this->offsetExists('active');
    }
}
