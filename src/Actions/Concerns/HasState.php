<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasState
{
    public function active(bool $active = true): static
    {
        $this->active = $active;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->value('active', false);
    }
}
