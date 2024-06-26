<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasState
{
    public function state(mixed $state = null): static
    {
        $this->state = $state;

        return $this;
    }

    public function default(mixed $default = null): static
    {
        $this->default = $default;

        return $this;
    }

    public function getState(): mixed
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
}
