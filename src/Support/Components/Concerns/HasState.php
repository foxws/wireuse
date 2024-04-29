<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasState
{
    public function state(?string $state = null): static
    {
        $this->state = $state;

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

    public function getActive(): mixed
    {
        return $this->value('active');
    }

    public function hasActive(): mixed
    {
        return $this->offsetExists('active');
    }
}
