<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasState
{
    public function state(?string $state = null): static
    {
        $this->state = $state;

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
}
